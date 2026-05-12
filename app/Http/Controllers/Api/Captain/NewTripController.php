<?php

namespace App\Http\Controllers\Api\Captain;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Enums\Transaction\TransactionReasonEnum;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Captain\Trip\CancelTripRequest;
use App\Http\Requests\Api\Captain\Trip\StartAndEndTripRequest;
use App\Http\Resources\Api\Captain\Trip\TrackTripResource;
use App\Http\Resources\Api\Captain\Trip\TripButItsTrackResource;
use App\Http\Resources\Api\Captain\Trip\TripResource;
use App\Http\Resources\Api\Captain\Trip\TripV2Resource;
use App\Http\Resources\Api\Client\Trip\NewTripResource;
use App\Jobs\GenerateReportPDFJob;
use App\Models\Track;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Services\DriversActions;
use Carbon\Carbon;
use Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use PDF;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewTripController extends ApiController
{
    function index(Request $request)
    {
        $currentTime = Carbon::now();
        $oneHourAdded = $currentTime->copy()->addMinutes(15);
        $filter = isset($request->filter) ? $request->filter : "all";
        $driverLat = auth()->user()->latitude;
        $driverLong = auth()->user()->longitude;
        $radiusInKM = setting('general', 'searchRange', 5);

        if ($filter == 'new' || $filter == 'upcoming' || $filter == 'previous') {
            $trips = Trip::query()
                ->where('parent_id', 0)
                ->when($filter == 'previous', function (Builder $builder) {
                    $builder->whereHas('driver', function ($q) {
                        $q->where('driver_id', auth()->id());
                    })
                        ->where(function ($q) {
                            $q->where(function ($q) {
                                $q->whereNotNull("start_at")->whereNull("end_at");
                            })->orWhere(function ($q) {
                                $q->whereNotNull("start_at")->whereNotNull("end_at");
                            })->orWhere(function ($q) {
                                $q->where("is_canceled", true);
                            });
                        })->where('parent_id', 0);
                })
                ->when($filter == 'new', function (Builder $builder) use ($radiusInKM, $driverLat, $driverLong) {
                    $builder->where(function ($q) use ($radiusInKM, $driverLong, $driverLat) {
                        $q->whereHas('driverTripOffers', function (Builder $builder) {
                            $builder->where('driver_trip_offers.driver_id', auth()->id())
                                ->where('status', 'pending');
                        })->whereHas('report', function ($q) {
                            $q->where('reservation_type', 'other');
                        })->whereDoesntHave('driver');
                    })->orWhere(function ($q) use ($radiusInKM, $driverLong, $driverLat) {
                        $q->whereHas('report', function ($q) {
                            $q->where('reservation_type', 'talebat');
                        })->whereDoesntHave('driverTripOffers', function ($q) {
                            $q->where('driver_id', auth()->id());
                        })->whereDoesntHave('driver')
                            ->when($driverLat && $driverLong, function ($q) use ($radiusInKM, $driverLong, $driverLat) {
                                $q->whereRaw("
                                    6371 * acos(
                                        cos(radians(?)) * cos(radians(CAST(JSON_UNQUOTE(JSON_EXTRACT(origin, '$.lat')) AS DECIMAL(10, 7)))) * 
                                        cos(radians(CAST(JSON_UNQUOTE(JSON_EXTRACT(origin, '$.lng')) AS DECIMAL(10, 7))) - radians(?)) + 
                                        sin(radians(?)) * sin(radians(CAST(JSON_UNQUOTE(JSON_EXTRACT(origin, '$.lat')) AS DECIMAL(10, 7))))
                                    ) <= ?
                                ", [
                                    $driverLat,
                                    $driverLong,
                                    $driverLat,
                                    $radiusInKM,
                                ]);
                            });
                    })->where('is_canceled', false)->where('parent_id', 0);
                })
                ->when($filter == 'upcoming', function (Builder $builder) use ($oneHourAdded, $currentTime) {
                    $builder->where(function ($query) use ($oneHourAdded, $currentTime) {
                        $query->where(function ($query) use ($oneHourAdded, $currentTime) {
                            $query->where(function ($query) use ($oneHourAdded, $currentTime) {
                                $query->whereRaw("time >= ?", [$currentTime->toTimeString()])
                                    ->orWhere(function ($q) use ($currentTime) {
                                        $q->whereRaw("time <= ?", [$currentTime->toTimeString()])
                                            ->whereRaw("(time + INTERVAL 15 MINUTE) >= ?", [$currentTime->toTimeString()]);
                                    });
                            })
                                ->whereNull("start_at")
                                ->whereNull("end_at")
                                ->where('is_canceled', false)
                                ->whereHas('driver', function (Builder $builder) {
                                    $builder->where('driver_id', auth()->id());
                                });
                        })->orWhere(function ($query) use ($oneHourAdded, $currentTime) {
                            $query->whereHas('children', function (Builder $builder) use ($oneHourAdded, $currentTime) {
                                $builder->where(function ($query) use ($oneHourAdded, $currentTime) {
                                    $query->whereRaw("time >= ?", [$currentTime->toTimeString()])
                                        ->orWhere(function ($q) use ($currentTime) {
                                            $q->whereRaw("time <= ?", [$currentTime->toTimeString()])
                                                ->whereRaw("(time + INTERVAL 15 MINUTE) >= ?", [$currentTime->toTimeString()]);
                                        });
                                })
                                    ->whereNull("start_at")
                                    ->whereNull("end_at")
                                    ->where('is_canceled', false)
                                    ->whereHas('driver', function (Builder $builder) {
                                        $builder->where('driver_id', auth()->id());
                                    });
                            });
                        });
                    })->where('parent_id', 0)->whereHas('report', function ($q) {
                        $q->where('is_paid', 1);
                    });
                })
                ->with(["report.trips", "client"])
                ->orderByDesc('id')
                ->get();

            $trips->map(function ($trip) {
                $driver = auth()->user();
                $distance['distance'] = $trip->report?->total_km < 1 ? 1 : $trip->report?->total_km;
                if ($trip->report?->reservation_type == 'talebat') {
                    $count = ($trip->children()->count() + 1);
                    $kmPrice = $driver->driverOrg ? $driver->driverOrg?->talebat_price : $driver->talebat_price;
                } else {
                    $count = 1;
                    $kmPrice = $driver?->driverOrg ? $driver?->driverOrg?->other_price : $driver?->other_price;
                }
                $subtotal = (double)round($distance['distance'] * $kmPrice * $count, 3);
                $taxPercentage = (double)setting('general', "tax", 14);
                $trip->tripTotal = $subtotal;
            });

        } else {
            $trips = Trip::query()
                ->where('parent_id', 0)
                ->where(function (Builder $builder) {
                    $builder->where(function ($q) {
                        $q->whereHas('driverTripOffers', function (Builder $builder) {
                            $builder->where('driver_trip_offers.driver_id', auth()->id())
                                ->where('status', 'pending');
                        })->whereHas('report', function ($q) {
                            $q->where('reservation_type', 'other');
                        })->whereDoesntHave('driver');
                    })->orWhere(function ($q) {
                        $q->whereHas('report', function ($q) {
                            $q->where('reservation_type', 'talebat');
                        })->whereDoesntHave('driverTripOffers', function ($q) {
                            $q->where('driver_id', auth()->id());
                        })->whereDoesntHave('driver');
                    });
                })->orWhere(function (Builder $builder) use ($oneHourAdded, $currentTime) {
                    $builder->where(function ($query) use ($oneHourAdded, $currentTime) {
                        $query->where(function ($query) use ($oneHourAdded, $currentTime) {
                            $query->whereRaw("time >= ? AND time <= ? AND date = ?", [$currentTime->toTimeString(), $oneHourAdded->toTimeString(), now()->toDateString()])
                                ->whereNull("start_at")
                                ->whereNull("end_at")
                                ->where('is_canceled', false)
                                ->whereHas('driver', function (Builder $builder) {
                                    $builder->where('driver_id', auth()->id());
                                });
                        })->orWhere(function ($query) use ($oneHourAdded, $currentTime) {
                            $query->whereHas('children', function (Builder $builder) use ($oneHourAdded, $currentTime) {
                                $builder->whereRaw("time >= ? AND time <= ? AND date = ?", [$currentTime->toTimeString(), $oneHourAdded->toTimeString(), now()->toDateString()])
                                    ->whereNull("start_at")
                                    ->whereNull("end_at")
                                    ->where('is_canceled', false)
                                    ->whereHas('driver', function (Builder $builder) {
                                        $builder->where('driver_id', auth()->id());
                                    });
                            });
                        });
                    });
                })
                ->with(["report.trips", "client", "chat"])
                ->orderByDesc('id')
                ->get();
        }

        return sendResponse(TripV2Resource::collection($trips));
    }

    function show(Trip $Trip)
    {
        return sendResponse(new TripV2Resource($Trip));
    }

    /**
     * @throws \Throwable
     */
    // public function acceptTrip(Trip $trip)
    // {
    //     $offer = $trip->driverTripOffers()
    //         ->where('driver_id', auth()->id())
    //         ->where('status', 'pending')
    //         ->first();
    //     if (!$offer) {
    //         return sendError(__("messages.there is no offer for this driver on this trip"));
    //     }
    //     DB::beginTransaction();
    //     $offer->update(['status' => 'accepted']);
    //     $trip->update(['driver_id' => auth()->id()]);

    //     $distance = (new DriversActions())->calcDistance(
    //         $trip->origin['lat'],
    //         $trip->origin['lng'],
    //         $trip->destination['lat'],
    //         $trip->destination['lng'],
    //     );
    //     $distance['distance'] = $distance['distance'] < 1 ? 1 : $distance['distance'];

    //     $kmPrice = auth()->user()?->driverOrg ? auth()->user()?->driverOrg?->other_price : auth()->user()?->other_price;
    //     $subtotal = $distance['distance'] * $kmPrice;
    //     $taxPercentage = (double)setting('general', "tax", 14);
    //     $general = setting('general');
    //     $appPercentage = +data_get($general, "appPercentage");

    //     $trip->report()?->update([
    //         'total_km' => $distance['distance'],
    //         "sub_total" => $subtotal,
    //         "tax_value" => ($subtotal * $taxPercentage) / 100,
    //         "app_commission" => ($subtotal * $appPercentage) / 100,
    //         "tax" => $taxPercentage,
    //         "total" => $subtotal + (($subtotal * $taxPercentage) / 100),
    //         "km_price" => $kmPrice,
    //         "accepted_time" => now()->format('Y-m-d H:i:s'),
    //     ]);

    //     $trip->chat()->updateOrCreate([
    //         'trip_id' => $trip->id
    //     ], [
    //         'receiver_id' => auth()->id()
    //     ]);

    //     DB::commit();

    //     $trip->client?->notify(new FcmNotification(
    //         $trip->client?->sendableTokens,
    //         ['ar' => __("messages.you_have_new_notification", [], 'ar'),
    //             'en' => __("messages.you_have_new_notification", [], 'en')],
    //         ['ar' => __("messages.trip :trip accepted by captain :captain", ['trip' => $trip->id, 'captain' => auth()->user()?->name], 'ar'),
    //             'en' => __("messages.trip :trip accepted by captain :captain", ['trip' => $trip->id, 'captain' => auth()->user()?->name], 'en')],
    //         FCMTopic::DRIVER_ACCEPT_TRIP,
    //         FCMAction::DRIVER_OPEN_UPCOMING_TRIPS,
    //         $trip->id,
    //     ));

    //     return sendResponse(__("messages.trip accepted successfully"));
    // }
public function acceptTrip(Trip $trip)
{
    $offer = $trip->driverTripOffers()
        ->where('driver_id', auth()->id())
        ->where('status', 'pending')
        ->first();

    if (!$offer) {
        return sendError(__("messages.there is no offer for this driver on this trip"));
    }

    DB::beginTransaction();

    $offer->update(['status' => 'accepted']);

    $trip->update(['driver_id' => auth()->id()]);

    $distance = (new DriversActions())->calcDistance(
        $trip->origin['lat'],
        $trip->origin['lng'],
        $trip->destination['lat'],
        $trip->destination['lng'],
    );

    $distance['distance'] = $distance['distance'] < 1 ? 1 : $distance['distance'];

    $kmPrice = auth()->user()?->driverOrg
        ? auth()->user()?->driverOrg?->other_price
        : auth()->user()?->other_price;

    $subtotal = $distance['distance'] * $kmPrice;

    $taxPercentage = (double) setting('general', "tax", 14);

    $general = setting('general');

    $appPercentage = +data_get($general, "appPercentage");

    $trip->report()?->update([
        'total_km' => $distance['distance'],
        "sub_total" => $subtotal,
        "tax_value" => ($subtotal * $taxPercentage) / 100,
        "app_commission" => ($subtotal * $appPercentage) / 100,
        "tax" => $taxPercentage,
        "total" => $subtotal + (($subtotal * $taxPercentage) / 100),
        "km_price" => $kmPrice,
        "accepted_time" => now()->format('Y-m-d H:i:s'),
    ]);

    $trip->chat()->updateOrCreate([
        'trip_id' => $trip->id
    ], [
        'receiver_id' => auth()->id()
    ]);

    DB::commit();

    /*
    // تم تعطيل إشعار Firebase مؤقتًا بسبب الخطأ:
    // Invalid JWT Signature

    $trip->client?->notify(new FcmNotification(
        $trip->client?->sendableTokens,
        [
            'ar' => __("messages.you_have_new_notification", [], 'ar'),
            'en' => __("messages.you_have_new_notification", [], 'en')
        ],
        [
            'ar' => __("messages.trip :trip accepted by captain :captain", [
                'trip' => $trip->id,
                'captain' => auth()->user()?->name
            ], 'ar'),
            'en' => __("messages.trip :trip accepted by captain :captain", [
                'trip' => $trip->id,
                'captain' => auth()->user()?->name
            ], 'en')
        ],
        FCMTopic::DRIVER_ACCEPT_TRIP,
        FCMAction::DRIVER_OPEN_UPCOMING_TRIPS,
        $trip->id,
    ));
    */

    return sendResponse(__("messages.trip accepted successfully"));
}

    public function rejectTrip(Trip $trip)
    {
        if ($trip->report?->reservation_type == 'other') {
            $offer = $trip->driverTripOffers()
                ->where('driver_id', auth()->id())
                ->where('status', 'pending')
                ->first();
            if (!$offer) {
                return sendError(__("messages.there is no offer for this driver on this trip"));
            }
            $offer->update(['status' => 'rejected']);
        } else {
            $trip->driverTripOffers()->create([
                'driver_id' => auth()->id(),
                'status' => 'rejected'
            ]);
        }

        $trip->report()?->update([
            'accepted_time_for_driver' => null,
        ]);

        /* 
            //send notif to client that the trip canceled 
            Notification::send($trip->client, new FcmNotification(
                $trip->client?->deviceTokens?->pluck('token')->toArray(),
                ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')],
                ['ar' => __("messages.trip :trip rejected from driver :driver", ['trip' => $trip->id,'driver' => auth()->user()?->name], 'ar'),
                    'en' => __("messages.trip :trip rejected from driver :driver", ['trip' => $trip->id,'driver' => auth()->user()?->name], 'en')],
                FCMTopic::DRIVER_REJECT_TRIP,
                FCMAction::DRIVER_OPEN_NEW_TRIPS,
                $trip->id,
            ));
        */

        /* new updates */
        
            $driverId = auth()->id();
            $driverName = auth()->user()?->name;

            /**
             * ✅ 3. Get NEXT captain (only one)
             */
            $nextDriver = User::where('role', 'captain')
                ->where('id', '!=', $driverId)

                // 🚫 exclude drivers who already rejected THIS trip
                ->whereDoesntHave('driverTripOffers', function ($q) use ($trip) {
                    $q->where('trip_id', $trip->id)
                      ->where('status', 'rejected');
                })

                // 🟢 optional filters
                ->where('is_available', 1)

                ->first(); // 👈 ONLY ONE captain

            /**
             * ✅ 4. Send trip to next captain
             */
            if ($nextDriver) {

                // create pending offer
                $trip->driverTripOffers()->create([
                    'driver_id' => $nextDriver->id,
                    'status' => 'pending',
                ]);

                // update timer again
                $trip->report()?->update([
                    'accepted_time_for_driver' => now()->format('Y-m-d H:i:s'),
                ]);

                /**
                 * 🔔 Notify NEW captain
                 */
                Notification::send($nextDriver, new FcmNotification(
                    $nextDriver->deviceTokens?->pluck('token')->toArray(),
                    [
                        'ar' => __("messages.you_have_new_trip", [], 'ar'),
                        'en' => __("messages.you_have_new_trip", [], 'en')
                    ],
                    [
                        'ar' => __("messages.new trip available #:trip", ['trip' => $trip->id], 'ar'),
                        'en' => __("messages.new trip available #:trip", ['trip' => $trip->id], 'en')
                    ],
                    FCMTopic::NEW_TRIP,
                    FCMAction::DRIVER_OPEN_NEW_TRIPS,
                    $trip->id,
                ));
            }

            /**
             * 🔔 5. Notify CLIENT
             */
            Notification::send($trip->client, new FcmNotification(
                $trip->client?->deviceTokens?->pluck('token')->toArray(),
                [
                    'ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')
                ],
                [
                    'ar' => $nextDriver
                        ? __("messages.trip :trip rejected from driver :driver and sent to another captain", ['trip' => $trip->id, 'driver' => $driverName], 'ar')
                        : __("messages.trip :trip rejected from driver :driver and no drivers available", ['trip' => $trip->id, 'driver' => $driverName], 'ar'),

                    'en' => $nextDriver
                        ? __("messages.trip :trip rejected from driver :driver and sent to another captain", ['trip' => $trip->id, 'driver' => $driverName], 'en')
                        : __("messages.trip :trip rejected from driver :driver and no drivers available", ['trip' => $trip->id, 'driver' => $driverName], 'en'),
                ],
                FCMTopic::DRIVER_REJECT_TRIP,
                FCMAction::DRIVER_OPEN_NEW_TRIPS,
                $trip->id,
            ));


        return sendResponse(__("messages.trip rejected"));
    }


    function deliveredToClient(StartAndEndTripRequest $request)
    {
        $trip = Trip::findOrFail($request->trip_id);
        $trip->update(["is_delivered_to_client" => 1]);

        Notification::send($trip->client, new FcmNotification(
            $trip->client?->deviceTokens?->pluck('token')->toArray(),
            ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')],
            ['ar' => __("messages.driver arrived", [], 'ar'),
                'en' => __("messages.driver arrived", [], 'en')],
            FCMTopic::DRIVER_ARRIVED_TO_CLIENT,
            FCMAction::DRIVER_OPEN_NEW_TRIPS,
            $trip->id,
        ));
        return sendResponse(new NewTripResource($trip));
    }

    function startTrip(StartAndEndTripRequest $request)
    {
        $trip = Trip::findOrFail($request->trip_id);

        if (!$trip->report?->is_paid) {
            return sendError(__('messages.trip not paid'));
        }

        if ($trip->is_canceled) {
            return sendError(__('messages.trip is canceled'));
        }

        $trip->update(["start_at" => Carbon::now()]);

        // admins
        $admins = User::role("admin")->get();
        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification($tokens,
                ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')],
                ['ar' => __('messages.trip is started number :trip', ['trip' => $trip->id], 'ar'),
                    'en' => __('messages.trip is started number :trip', ['trip' => $trip->id], 'en')],
                FCMTopic::ADMIN_TRIP_STARTED, FCMAction::NO_ACTION));
        }

        // users
        $tokens = $trip->client->sendableTokens;
        $trip->client->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"),
            __('messages.trip is started number :trip', ['trip' => $trip->id]),
            FCMTopic::CLIENT_TRIP_STARTED, FCMAction::CLIENT_OPEN_CURRENT_TRIPS, $trip->id));

        return sendResponse(new NewTripResource($trip));
    }

    function finishTrip(StartAndEndTripRequest $request)
    {
        $trip = Trip::findOrFail($request->trip_id);

        if ($trip->is_canceled) {
            return sendError(__('messages.trip is canceled'));
        }

        if (is_null($trip->start_at)) {
            return sendError(__('messages.The trip cannot be ended before it starts.'));
        }

        if (!is_null($trip->start_at) && !is_null($trip->end_at)) {
            return sendError(__('messages.The trip is already ended'));
        }

        $trip->update(["end_at" => Carbon::now()]);


        $sendNotificationToAdminsIfDriverGainMoney = false;
        if ($trip->report?->reservation_type == 'talebat') {
            $allTripsCount = $trip->report?->trips()->count();
            $allFinishedTripsCount = $trip->report?->trips()->whereNotNull('start_at')->whereNotNull('end_at')->count();

            if ($allTripsCount == $allFinishedTripsCount) {
                auth()->user()->update([
                    "balance" => auth()->user()->balance + $trip->report?->sub_total
                ]);
                $sendNotificationToAdminsIfDriverGainMoney = true;
            }
        } else {
            $general = setting('general');
            $appPercentage = +data_get($general, "appPercentage");

            if (auth()->user()->driverOrg()->exists()) {
                auth()->user()->driverOrg()->update([
                    "balance" => auth()->user()->driverOrg?->balance + ($trip->report?->sub_total - $trip->report?->app_commission)
                ]);
            } else {
                auth()->user()->update([
                    "balance" => auth()->user()->balance + ($trip->report?->sub_total - $trip->report?->app_commission)
                ]);
            }


            $sendNotificationToAdminsIfDriverGainMoney = true;
        }

        # Generate Qr
        $this->generateQr($trip);


        // admins
        $admins = User::role("admin")->get();
        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification($tokens,
                ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')],
                ['ar' => __('messages.trip is finished number :trip', ['trip' => $trip->id], 'ar'),
                    'en' => __('messages.trip is finished number :trip', ['trip' => $trip->id], 'en')],
                FCMTopic::DRIVER_TRIP_FINISHED, FCMAction::NO_ACTION));

            if ($sendNotificationToAdminsIfDriverGainMoney) {
                $admin->notify(new FcmNotification($tokens,
                    ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                        'en' => __("messages.you_have_new_notification", [], 'en')],
                    ['ar' => __('messages.driver :driver gain :gain from trip :trip', ['driver' => auth()->user()->name, 'gain' => $trip->report?->sub_total,
                        'trip' => !$trip->parent_id ? $trip->id : $trip->parent?->id], 'ar'),
                        'en' => __('messages.driver :driver gain :gain from trip :trip', ['driver' => auth()->user()->name, 'gain' => $trip->report?->sub_total,
                            'trip' => !$trip->parent_id ? $trip->id : $trip->parent?->id], 'en')],
                    FCMTopic::DRIVER_TRIP_FINISHED, FCMAction::NO_ACTION));
            }
        }

        // users
        $tokens = $trip->client->sendableTokens;
        $trip->client->notify(new FcmNotification($tokens,
            ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')],
            ['ar' => __('messages.trip is finished number :trip', ['trip' => $trip->id], 'ar'),
                'en' => __('messages.trip is finished number :trip', ['trip' => $trip->id], 'en')],
            FCMTopic::CLIENT_TRIP_FINISHED, FCMAction::CLIENT_OPEN_PREVIOUS_TRIPS, $trip->id));

        return sendResponse(new NewTripResource($trip));
    }

    public function generateQr($trip)
    {
        $report = $trip->report;
        $tempDirectory = 'temp';
        $filePath = $tempDirectory . '/' . $report->id . '.svg';

        if (!Storage::disk('local')->exists($tempDirectory)) {
            Storage::disk('local')->makeDirectory($tempDirectory);
        }
        $report->qrStr(
            url('/client/trip/get-details-pdf/' . $report->id . '/' . get_current_lang()),
            Storage::disk('local')->path($filePath)
        );


        if (Storage::disk('local')->exists('temp/' . $report->id . '.svg')) {
            $report->addMedia(new UploadedFile(Storage::disk('local')->path('temp/' . $report->id . '.svg'), time() . '.svg'))->toMediaCollection('receiptQR');
            $report->refresh();
        }
    }


    function cancelTrip(CancelTripRequest $request)
    {
        $trip = Trip::findOrFail($request->trip_id);

        DB::beginTransaction();

        # If Other Or Talebat And Trip Is Upcoming
        if (is_null($trip->start_at) && is_null($trip->end_at)) {
            $discount_from_driver_when_cancel_trip = setting('price', 'discount_from_driver_when_cancel_trip', 5);
            $taxValue = $trip->report?->sub_total * ($discount_from_driver_when_cancel_trip / 100);


            if (auth()->user()->driverOrg()->exists()) {
                auth()->user()->driverOrg()->update(["balance" => auth()->user()->driverOrg?->balance - $taxValue]);
            } else {
                auth()->user()->update([
                    "balance" => auth()->user()?->balance - $taxValue
                ]);
            }

            $trip->client?->walletType(
                'money',
                transactionType: 'deposit',
            )->walletTransactionReason(TransactionReasonEnum::cancel_trip()->value)
                ->walletSteps($trip->report?->sub_total + $taxValue, true)
                ->walletCreate();

            if ($trip->report?->reservation_type != 'other') {
                $trip->children()->update([
                    'is_canceled' => true,
                    'cancel_reason' => $request->cancel_reason,
                ]);
            }
        }

        # If Other And Trip Is Current
        if (!is_null($trip->start_at) && is_null($trip->end_at) && $trip->report?->reservation_type == 'other') {
            $distance = (new DriversActions())->calcDistance(
                $trip->origin['lat'],
                $trip->origin['lng'],
                $request->driver_current_lat,
                $request->driver_current_long,
            );

            $driverGainAccordingToCuttingDistance = $distance['distance'] * $trip->report?->km_price;
            $taxPercentage = (double)setting('general', "tax", 14);
            $driverGainAccordingToCuttingDistanceAfterTax = ($driverGainAccordingToCuttingDistance * $taxPercentage) / 100;

            // auth()->user()->update([
            //     "balance" => auth()->user()->balance + ($driverGainAccordingToCuttingDistance - $driverGainAccordingToCuttingDistanceAfterTax)
            // ]);

            if (auth()->user()->driverOrg()->exists()) {
                auth()->user()->driverOrg()->update([auth()->user()->driverOrg?->balance + ($driverGainAccordingToCuttingDistance - $driverGainAccordingToCuttingDistanceAfterTax)]);
            } else {
                auth()->user()->update([
                    "balance" => auth()->user()?->balance + ($driverGainAccordingToCuttingDistance - $driverGainAccordingToCuttingDistanceAfterTax)
                ]);
            }

            $trip->client?->walletType(
                'money',
                transactionType: 'deposit',
            )->walletTransactionReason(TransactionReasonEnum::cancel_trip()->value)
                ->walletSteps($trip->report?->sub_total - ($driverGainAccordingToCuttingDistance - $driverGainAccordingToCuttingDistanceAfterTax), true)
                ->walletCreate();
        }

        $trip->update([
            'is_canceled' => true,
            'cancel_reason' => $request->cancel_reason,
        ]);

        DB::commit();

        // admins
        $admins = User::role("admin")->get();
        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification($tokens,
                ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')],
                ['ar' => __('messages.trip is canceled number :trip by captain', ['trip' => $trip->id], 'ar'),
                    'en' => __('messages.trip is canceled number :trip by captain', ['trip' => $trip->id], 'en')],
                FCMTopic::ADMIN_TRIP_STARTED, FCMAction::NO_ACTION));
        }

        // users
        $tokens = $trip->client->sendableTokens;
        $trip->client->notify(new FcmNotification($tokens,
            ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')],
            ['ar' => __('messages.trip is canceled number :trip by captain', ['trip' => $trip->id], 'ar'),
                'en' => __('messages.trip is canceled number :trip by captain', ['trip' => $trip->id], 'en')],
            FCMTopic::CLIENT_CANCELED_TRIP, FCMAction::DRIVER_CANCEL_TRIP, $trip->id));

        return sendResponse(__('messages.trip is canceled'));

    }


    function sendOfferOnTalebatTrip(Trip $trip)
    {
        if ($trip->report?->reservation_type == 'other') {
            return sendError(__('messages.the trip type must be talebat'));
        }

        # If Already Send Offer To The Captain
        if ($trip->driverTripOffers()->where('driver_id', auth()->id())->where(['status' => 'pending'])->exists()) {
            return sendResponse(__("messages.Trip Has Pending Request"));
        }

        auth()->user()->driverTripOffers()?->updateOrCreate([
            'trip_id' => $trip->id,
            'status' => 'pending',
        ]);

        Notification::send($trip->client, new FcmNotification(
            $trip->client?->deviceTokens?->pluck('token')->toArray(),
            ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')],
            ['ar' => __("messages.you have a new request from captain :captain on trip :trip", ['trip' => $trip->id, 'captain' => auth()->user()?->name], 'ar'),
                'en' => __("messages.you have a new request from captain :captain on trip :trip", ['trip' => $trip->id, 'captain' => auth()->user()?->name], 'en')],
            FCMTopic::DRIVER_ACCEPT_TRIP,
            FCMAction::DRIVER_OPEN_UPCOMING_TRIPS,
            $trip->id,
        ));
        return sendResponse(__("messages.send to the client"));
    }

    public function settings()
    {
        return sendResponse([
            'search_time' => setting('general', 'captain_accept_reject_time', 5),
            'client_trip_payment_time_before_cancel' => setting('general', 'client_trip_payment_time_before_cancel', 5),
        ]);

    }

}