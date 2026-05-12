<?php

namespace App\Http\Controllers\Api\Client;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Enums\Transaction\TransactionReasonEnum;
use App\Events\ClientPayTripEvent;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Client\TripV2\RateTripRequest;
use App\Http\Requests\Api\Client\TripV2\SearchTripRequest;
use App\Http\Requests\Api\Client\TripV2\StoreTripRequest;
use App\Http\Resources\Api\Client\Trip\CaptainModelResource;
use App\Http\Resources\Api\Client\Trip\NewTripResource;
use App\Http\Resources\Api\Client\Trip\SearchTripResource;
use App\Http\Resources\Api\Client\Trip\TripResource;
use App\Jobs\GenerateReportPDFJob;
use App\Models\Chat;
use App\Models\Report;
use App\Models\Track;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Services\DriversActions;
use App\Support\Helper\MhelperClass;
use App\Trait\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;

class TripV2Controller extends ApiController
{
    use SearchTrait;

    public function index(Request $request)
    {
        $currentTime = Carbon::now();
        $oneHourAdded = $currentTime->copy()->addHour();


        $filter = isset($request->filter) ? $request->filter : "previous";
        $data = Trip::query()
            ->where('parent_id', 0)
            ->where('client_id', auth()->id())
            ->whereHas('report')
            ->when($filter == 'current', function ($q) {
                $q->whereHas('driver')->where('is_canceled', 0)->whereNotNull("start_at")->whereNull("end_at")
                    ->whereHas('report', function ($q) {
                        $q->where('is_paid', 1);
                    })->where('client_id', auth()->id())->where('parent_id', 0);
            })
            ->when($filter == 'previous', function ($q) {
                $q->whereHas('driver')
                    ->where('client_id', auth()->id())
                    ->where(function ($q) {
                        $q->where(function ($q) {
                            $q->whereNotNull("start_at")->whereNotNull("end_at");
                        })->orWhere(function ($q) {
                            $q->whereNotNull("start_at")->whereNull("end_at")->where('is_canceled', 1);
                        })->orWhere(function ($q) {
                            $q->whereNull("start_at")->whereNull("end_at");
                        });
                    })
                    ->whereHas('report', function ($q) {
                        $q->where('is_paid', 1);
                    })
                    ->where('parent_id', 0);
            })
            ->when($filter == 'new', function ($q) {
                $q->where(function ($q) {
                    $q->whereDoesntHave('driver')->where('is_canceled', 0);
                })->orWhere(function ($q) {
                    $q->whereHas('driver')->where('is_canceled', 0)->whereHas('report', function ($q) {
                        $q->where('is_paid', 0);
                    });
                })->where('client_id', auth()->id())->where('parent_id', 0);
            })->when($filter == 'upcoming', function ($q) use ($oneHourAdded, $currentTime) {
                $q->whereHas('driver')
                    ->where('client_id', auth()->id())
                    ->whereHas('report', function ($q) {
                        $q->where('is_paid', 1);
                    })
                    ->where(function ($q) use ($oneHourAdded, $currentTime) {
                        $q->whereRaw("time >= ? AND time <= ? AND date = ?", [$currentTime->toTimeString('minutes'), $oneHourAdded->toTimeString('minutes'), now()->toDateString()])
                            ->whereNull("start_at")->whereNull("end_at")->where('is_canceled', false);
                    })->orWhere(function ($query) use ($oneHourAdded, $currentTime) {
                        $query->whereHas('children', function (Builder $builder) use ($oneHourAdded, $currentTime) {
                            $builder->whereRaw("time >= ? AND time <= ? AND date = ?", [$currentTime->toTimeString(), $oneHourAdded->toTimeString(), now()->toDateString()])
                                ->whereNull("start_at")
                                ->whereNull("end_at")
                                ->where('client_id', auth()->id())
                                ->where('is_canceled', false);
                        });
                    })->where('parent_id', 0);
            })
            ->with(["report.trips", "client", 'chat'])
            ->orderByDesc('created_at')
            ->get()
            ->each(function ($trip) use ($filter) {
                $trip->status = $filter;
                return $trip;
            });

        return sendResponse(NewTripResource::collection($data));
    }


    public function show(Trip $Trip)
    {
        $status = '';
        if ($Trip->driver && !is_null($Trip->start_at) && !is_null($Trip->end_at) && $Trip->parent_id == 0 && $Trip->report?->is_paid == 0) {
            $status = 'previous';
        } elseif ((!$Trip->driver || ($Trip->driver && $Trip->report?->is_paid == 0)) && $Trip->is_canceled == 0) {
            $status = 'new';
        }
        $Trip->status = $status;
        $Trip->load(['report', 'driver', 'owner']);
        return sendResponse(new NewTripResource($Trip));
    }

    public function rateTrip(RateTripRequest $request, Trip $trip)
    {
        $trip->load(["driver.deviceTokens"]);

        tap($trip)->update($request->validated())->fresh();

        $orgOrCapTrips = Trip::select(["id", "track_id", "owner_id", "rate"])
            ->where('parent_id', 0)
            ->where('is_canceled', 0)
            ->where('rate', '>', 0)
            ->whereHas("driver", function ($q) use ($trip) {
                return $q->whereId($trip->driver_id);
            });

        $orgOrCapRate = number_format($orgOrCapTrips->avg("rate"), 2, '.', '');

        tap($trip->driver)?->update(["rate" => $orgOrCapRate])->fresh();

        // captain or org
        $tokens = $trip->driver?->sendableTokens;
        $trip->driver?->notify(new FcmNotification(
            $tokens,
            [
                'ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')
            ],
            [
                'ar' => __("messages.you have been rated by client :client", ['client' => auth()->user()->name], 'ar'),
                'en' => __("messages.you have been rated by client :client", ['client' => auth()->user()->name], 'en')
            ],
            FCMTopic::OWNER_TRIP_RATED,
            FCMAction::OWNER_TRIP_RATED,
            $trip->id
        ));

        // admins
        $admins = User::role("admin")->with(['deviceTokens'])->get();
        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification(
                $tokens,
                [
                    'ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')
                ],
                [
                    'ar' => __("messages.driver :driver rated by client :client", ['driver' => $trip->driver?->name, 'client' => auth()->user()->name], 'ar'),
                    'en' => __("messages.driver :driver rated by client :client", ['driver' => $trip->driver?->name, 'client' => auth()->user()->name], 'en')
                ],
                FCMTopic::ADMIN_TRIP_RATED,
                FCMAction::ADMIN_TRIP_RATED
            ));
        }

        return sendResponse(new NewTripResource($trip));
    }

    public function store(SearchTripRequest $request)
    {
        DB::beginTransaction();
        $trip = Trip::create([
            'client_id' => auth()->id(),
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'origin' => $request->origin,
            'destination' => $request->destination,
            'time' => $request->time,
            'parent_id' => 0,
        ]);

        if (!empty($trip)) {
            $distance = (new DriversActions())->calcDistance(
                $trip->origin['lat'],
                $trip->origin['lng'],
                $trip->destination['lat'],
                $trip->destination['lng'],
            );
            # Generate Report
            $report = Report::create([
                "total_km" => $distance["distance"] < 1 ? 1 : $distance["distance"],
                "duration" => $distance["duration"],
                "sub_total" => 0,
                "tax_value" => 0,
                "tax" => 0,
                "total" => 0,
                "payment_method" => 'not paid',
                "km_price" => 0,
                "reservation_type" => 'other',
                "start_date" => Carbon::parse($request->date)->format('Y-m-d'),
                "end_date" => Carbon::parse($request->date)->format('Y-m-d'),
            ]);
            # LINK TRIPS TO REPORT
            $trip->update(['report_id' => $report->id]);

            // dd('a');
            # Create Chat
            $this->createTripChat($trip);
        }

        DB::commit();

        # NOTIFY CLIENT
       // $this->notifyClients($request, $trip);

        return sendResponse(NewTripResource::make($trip), __("messages.resource_created"));
    }

    // public function search(Trip $trip)
    // {
    //     $closestDrivers = (new DriversActions())->nearestDrivers($trip->origin['lat'], $trip->origin['lng'], $trip);
    //     $distance = (new DriversActions())->calcDistance(
    //         $trip->origin['lat'],
    //         $trip->origin['lng'],
    //         $trip->destination['lat'],
    //         $trip->destination['lng'],
    //     );

    //     $closestDrivers->map(function ($driver) use ($distance, $trip) {

    //         $driverUnfinishedTripsCountInSameDate = $driver->driverTrips?->where("date", $trip->date)
    //             ->whereNotNull('start_at')->whereNull('end_at')->count();
    //         $validCapacity = $driver->driverVehicle?->year?->model?->capacity;

    //         $distance['distance'] = $distance['distance'] < 1 ? 1 : $distance['distance'];

    //         $kmPrice = $driver?->driverOrg ? $driver?->driverOrg?->other_price : $driver?->other_price;
    //         $subtotal = $distance['distance'] * $kmPrice;
    //         $taxPercentage = (float)setting('general', "tax", 14);

    //         $driver->tripTotal = $subtotal + (($subtotal * $taxPercentage) / 100);
    //         $driver->validSeats = $validCapacity - $driverUnfinishedTripsCountInSameDate;
    //     });

    //     $availableDrivers = $closestDrivers->filter(function ($driver) use ($trip) {
    //         foreach (
    //             $driver->driverTrips()->where('parent_id', 0)
    //                 ->whereNull('start_at')
    //                 ->whereNull('end_at')
    //                 ->orderByDesc('created_at')->get() as $driverTrip
    //         ) {
    //             if ($driverTrip->date !== $trip->date) {
    //                 continue;
    //             }

    //             // Calculate start and end times for the existing trip
    //             $existingTripStartTime = \Carbon\Carbon::parse($driverTrip->time);
    //             $existingTripEndTime = $existingTripStartTime->copy()->addMinutes($driverTrip->report->duration)->format('H:i');



    //             // Calculate start and end times for the new trip
    //             $newTripStartTime = \Carbon\Carbon::parse($trip->time)->format('H:i');
    //             // $newTripEndTime = $newTripStartTime->copy()->addMinutes($trip->report->duration); // Assuming `duration` for new trip is in the report

    //             // // Check for time overlap
    //             // 11:40
    //             // 11:40 - 11:50

    //             // 11:40 >= 11:40 && 11:40 <= 11:50
    //             if (
    //                 ($newTripStartTime >= $existingTripStartTime->format('H:i') && $newTripStartTime <= $existingTripEndTime)
    //             ) {
    //                 if ($driverTrip->is_canceled == 0 && $trip->date == $driverTrip->date) {
    //                     // There's an overlap, so this driver is not available
    //                     return false;
    //                 }
    //             }
    //         }
    //         return true;
    //     });


    //     return sendResponse(CaptainModelResource::collection($availableDrivers->load(['driverTrips'])));
    // }
public function search(Trip $trip)
{
    $driversActions = new DriversActions();

    $closestDrivers = $driversActions->nearestDrivers(
        $trip->origin['lat'],
        $trip->origin['lng'],
        $trip
    );

    $distance = $driversActions->calcDistance(
        $trip->origin['lat'],
        $trip->origin['lng'],
        $trip->destination['lat'],
        $trip->destination['lng'],
    );

    $availableDrivers = $closestDrivers->filter(function ($driver) use ($distance, $trip) {

        $unfinishedTripsCount = $driver->driverTrips()
            ->where('date', $trip->date)
            ->whereNotNull('start_at')
            ->whereNull('end_at')
            ->where('is_canceled', 0)
            ->count();

        $capacity = $driver->vehicleYear?->model?->capacity ?? 0;

        $validSeats = $capacity - $unfinishedTripsCount;

        $distanceValue = $distance['distance'] < 1 ? 1 : $distance['distance'];

        $kmPrice = $driver->driverOrg
            ? $driver->driverOrg?->other_price
            : $driver->other_price;

        $subtotal = $distanceValue * ($kmPrice ?? 0);

        $taxPercentage = (float) setting('general', 'tax', 14);

        $driver->tripTotal = $subtotal + (($subtotal * $taxPercentage) / 100);
        $driver->validSeats = $validSeats;

        if ($validSeats <= 0) {
            return false;
        }

        $driverTrips = $driver->driverTrips()
            ->where('parent_id', 0)
            ->where('date', $trip->date)
            ->whereNull('end_at')
            ->orderByDesc('created_at')
            ->get();

        foreach ($driverTrips as $driverTrip) {

            if ($driverTrip->is_canceled == 1) {
                continue;
            }

            $existingStart = \Carbon\Carbon::parse($driverTrip->time);

            $existingEnd = $existingStart->copy()
                ->addMinutes($driverTrip->report?->duration ?? 0);

            $newStart = \Carbon\Carbon::parse($trip->time);

            $newEnd = $newStart->copy()
                ->addMinutes($trip->report?->duration ?? 0);

            $hasOverlap =
                $newStart < $existingEnd &&
                $newEnd > $existingStart;

            if ($hasOverlap) {
                return false;
            }
        }

        return true;

    })->values();

    $availableDrivers->load([
        'driverTrips',
        'vehicleYear.model',
        'vehicle',
        'driverOrg',
    ]);

    return sendResponse(
        CaptainModelResource::collection($availableDrivers)
    );
}

    public function sendDriverOffer(Trip $trip, User $driver)
    {
        $driverUnfinishedTripsCountInSameDate = $driver->driverTrips()->where("date", $trip->date)
            ->whereNotNull('start_at')->whereNull('end_at')->where('is_canceled', 0)->count();

        $validCapacity = $driver->driverVehicle?->year?->model?->capacity;

        # If No Seats Available With This Driver In Trip Date
        // if ($validCapacity <= $driverUnfinishedTripsCountInSameDate) {
        //     return sendResponse(__("messages.There is no seats available with this captain"));
        // }

        # If Already Send Offer To The Captain
        if ($trip->driverTripOffers()->where(['status' => 'pending'])->exists()) {
            return sendResponse(__("messages.Trip Has Pending Request"));
        }

        $trip->report()?->update([
            'accepted_time_for_driver' => now()->format('Y-m-d H:i:s'),
        ]);

        $driver->driverTripOffers()?->updateOrCreate([
            'trip_id' => $trip->id,
            'status' => 'pending',
        ]);

        $this->notifyDrivers($driver, $trip);

        return sendResponse(__("messages.send to the captain"));
    }

    public function cancelTrip(Request $request, Trip $trip)
    {
        $request->validate(['cancel_reason' => 'nullable|string']);

        $discount_from_client_when_cancel_trip = setting('price', 'discount_from_client_when_cancel_trip', 10);
        $taxValue = $trip->report?->sub_total * ($discount_from_client_when_cancel_trip / 100);

        if ($trip->report?->reservation_type != 'other') {
            $trip->children()->update([
                'is_canceled' => true,
                'cancel_reason' => $request->cancel_reason,
            ]);
        }
        $trip->update([
            'is_canceled' => true,
            'cancel_reason' => $request->cancel_reason,
        ]);

        $trip->driver()?->update([
            "balance" => $trip->driver?->balance + $taxValue
        ]);

        auth()->user()?->walletType(
            'money',
            transactionType: 'withdrawal',
        )->walletTransactionReason(TransactionReasonEnum::cancel_trip()->value)
            ->walletSteps($taxValue, true)
            ->walletCreate();

        auth()->user()?->walletType(
            'money',
            transactionType: 'deposit',
        )->walletTransactionReason(TransactionReasonEnum::restore_money_from_cancel_trip()->value)
            ->walletSteps($trip->report?->sub_total, true)
            ->walletCreate();

        Notification::send($trip?->driver, new FcmNotification(
            $trip?->driver?->deviceTokens?->pluck('token')->toArray(),
            [
                'ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')
            ],
            [
                'ar' => __("messages.client cancel :trip and reason is :reason", ['trip' => $trip->id, 'reason' => $request->cancel_reason], 'ar'),
                'en' => __("messages.client cancel :trip and reason is :reason", ['trip' => $trip->id, 'reason' => $request->cancel_reason], 'en')
            ],
            FCMTopic::CLIENT_CANCELED_TRIP,
            FCMAction::DRIVER_OPEN_CURRENT_TRIPS,
            $trip?->id,
        ));

        // admins
        $admins = User::role("admin")->get();
        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification(
                $tokens,
                t_("messages.you_have_new_notification"),
                __('messages.client cancel :trip and reason is :reason', ['trip' => $trip->id, 'reason' => $request->cancel_reason]),
                FCMTopic::CLIENT_CANCELED_TRIP,
                FCMAction::NO_ACTION
            ));
        }

        return sendResponse(__('messages.trip is canceled'));
    }

   
  public function payTripAfterAcceptedForCaptain(Request $request, Trip $trip)
    {
        $request->validate([
            'payment_method' => 'required|in:online,wallet',
            'payment_method_id' => 'required_if:payment_method,online',
        ]);

        # If Wallet
        if ($request->payment_method == 'wallet') {
            if (auth()->user()?->wallet()->sum('steps') < $trip->report?->total) {
                return sendError(__("messages.wallet balance not enough"));
            }

            auth()->user()?->walletType(
                'money',
                transactionType: 'withdrawal',
            )->walletTransactionReason(TransactionReasonEnum::pay_trip()->value)
                ->walletSteps($trip->report?->total, true)
                ->walletCreate();

            $trip->report()?->update(['payment_method' => 'wallet', 'is_paid' => 1, "accepted_time" => null]);
        }  else {

    $invoice_number = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);

    $transactionData = [
        'invoice_number' => $invoice_number,
        'type' => 'pay_trip',
        'trip_id' => $trip->id,
    ];

    $transaction = auth()->user()->transactions()->create([
        'pay_data' => $transactionData,
        'pay_id' => (string) Str::uuid(),
        'payment_method' => 'moyasar',
        'amount' => $trip->report?->total,
        'transaction_reasons' => 'pay_trip',
        'status' => 'not_paid',
    ]);

    return response()->json([
        'status' => true,
        'payment_url' => route('api.moyasar.trip.page', $transaction->id),
    ]);
}
        event(new ClientPayTripEvent($trip));

        $trip->driver?->notify(new FcmNotification(
            $trip->driver?->sendableTokens,
            [
                'ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')
            ],
            [
                'ar' => __("messages.client pay trip :trip", ['trip' => $trip->id], 'ar'),
                'en' => __("messages.client pay trip :trip", ['trip' => $trip->id], 'en')
            ],
            FCMTopic::DRIVER_TRIP_BOOKED,
            FCMAction::DRIVER_OPEN_PREVIOUS_TRIPS,
            $trip?->id,
        ));

        return sendResponse(__("messages.trip is paid"));
    }
public function moyasarTripPage(Transaction $transaction)
{
   
    abort_if($transaction->status === 'paid', 403);

    $paymentAmount = (float) $transaction->amount;
    $number = (int) round($paymentAmount * 100);

    $description = 'Pay Trip #' . ($transaction->pay_data['trip_id'] ?? '');
    $lang = app()->getLocale();

    return view('payments.moyasar-trip', compact(
        'transaction',
        'number',
        'description',
        'lang'
    ));
}

public function moyasarTripCallback(Request $request)
{
    $request->validate([
        'id' => 'required|string',
        'status' => 'required|string',
        'transaction_id' => 'required|exists:transactions,id',
    ]);

    $transaction = Transaction::findOrFail($request->transaction_id);

    $response = Http::withBasicAuth(config('services.moyasar.secret_key'), '')
        ->get('https://api.moyasar.com/v1/payments/' . $request->id);

    if (!$response->successful()) {
        return sendError(__('messages.payment verification failed'));
    }

    $payment = $response->json();

    if (($payment['status'] ?? null) !== 'paid') {
        $transaction->update([
            'status' => 'failed',
            'response_data' => $payment,
        ]);

        return sendError(__('messages.payment failed'));
    }

    $tripId = $transaction->pay_data['trip_id'] ?? null;
    $trip = Trip::with('report', 'driver')->findOrFail($tripId);

    $transaction->update([
        'status' => 'paid',
       
        'response_data' => $payment,
    ]);

    $trip->report()->update([
        'payment_method' => 'moyasar',
        'is_paid' => 1,
        'accepted_time' => null,
    ]);

    event(new ClientPayTripEvent($trip));

    $trip->driver?->notify(new FcmNotification(
        $trip->driver?->sendableTokens,
        [
            'ar' => __("messages.you_have_new_notification", [], 'ar'),
            'en' => __("messages.you_have_new_notification", [], 'en')
        ],
        [
            'ar' => __("messages.client pay trip :trip", ['trip' => $trip->id], 'ar'),
            'en' => __("messages.client pay trip :trip", ['trip' => $trip->id], 'en')
        ],
        FCMTopic::DRIVER_TRIP_BOOKED,
        FCMAction::DRIVER_OPEN_PREVIOUS_TRIPS,
        $trip->id,
    ));

    return sendResponse(__('messages.trip is paid'));
}
    public function notifyDrivers($driver, $trip): void
    {

        //        $admins = User::with('deviceTokens')->whereHas('roles', function ($q) {
        //            $q->whereIn('name', ['super', 'admin']);
        //        })->get();
        //
        //        $notifable = $driver->driverOrg()->exists() ? $driver->driverOrg : $admins;
        //
        //        $tokens = $driver->driverOrg()->exists() ? $driver->driverOrg?->deviceTokens?->pluck('token')->toArray() :
        //            $admins?->pluck('deviceTokens')->flatten()?->pluck('token')->toArray();

        //        Notification::send($notifable, new FcmNotification(
        //            $tokens,
        //            __("messages.you_have_new_notification"),
        //            t_("messages.client_purchased_new_trips"),
        //            FCMTopic::DRIVER_TRIP_BOOKED,
        //            FCMAction::DRIVER_OPEN_UPCOMING_TRIPS,
        //            $trip?->id,
        //        ));

        $driver->notify(new FcmNotification(
            $driver?->sendableTokens,
            [
                'ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')
            ],
            [
                'ar' => __("messages.you have a new offer on trip :trip", ['trip' => $trip->id], 'ar'),
                'en' => __("messages.you have a new offer on trip :trip", ['trip' => $trip->id], 'en')
            ],
            FCMTopic::DRIVER_TRIP_BOOKED,
            FCMAction::DRIVER_OPEN_NEW_TRIPS,
            $trip?->id,
        ));
    }

    public function notifyClients($request, $trip): void
    {
        $user = $request->user()->load('deviceTokens');
        $user->notify(new FcmNotification(
            $user->sendableTokens,
            [
                'ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')
            ],
            [
                'ar' => __("messages.you_purchased_new_trips", [], 'ar'),
                'en' => __("messages.you_purchased_new_trips", [], 'en')
            ],
            FCMTopic::CLIENT_OTHER_TRIP,
            FCMAction::CLIENT_OPEN_NEW_TRIPS,
            $trip->id,
        ));
    }

    private function createTripChat($trip): void
    {
        Chat::firstOrCreate([
            'trip_id'    => $trip->id,
            'sender_id'  => auth()->id(),
            'receiver_id'=> 0,
        ]);
        /*
            Chat::updateOrCreate([
                'trip_id' => $trip->id
            ], [
                'sender_id' => auth()->id(),
                'receiver_id' => 0
            ]);
        */
    }

    public function settings()
    {
        return sendResponse([
            'client_trip_payment_time_before_cancel' => setting('general', 'client_trip_payment_time_before_cancel', 5),
        ]);
    }

    public function generatePdf($id, $lang = 'ar')
    {
        app()->setLocale($lang);
        $report = Report::withoutGlobalScopes()->findOrFail($id);

        //        $tempDirectory = 'temp';
        //        $filePath = $tempDirectory . '/' . $report->id . '.svg';
        //
        //        if (!Storage::disk('local')->exists($tempDirectory)) {
        //            Storage::disk('local')->makeDirectory($tempDirectory);
        //        }
        //        $report->qrStr(
        //            url('/client/trip/get-details-pdf/' . $report->id . '/' . get_current_lang()),
        //            Storage::disk('local')->path($filePath)
        //        );
        //
        //
        //        if (Storage::disk('local')->exists('temp/' . $report->id . '.svg')) {
        //            $report->addMedia(new UploadedFile(Storage::disk('local')->path('temp/' . $report->id . '.svg'), time() . '.svg'))->toMediaCollection('receiptQR');
        //            $report->refresh();
        //        }

        $receiptPDF = PDF::loadView('invoice', [
            'report' => $report,
            'locale' => app()->getLocale(),
            'appname' => __('Muasalat', [], $lang),
            'address' => __('address', [], $lang),
            'user' => $report->trips?->first()?->client,
        ], [], [
            'default_font' => 'sans-serif',
        ]);
        $pdfName = 'invoice' . $report->id . '.pdf';
        return $receiptPDF->stream($pdfName);
    }
}
