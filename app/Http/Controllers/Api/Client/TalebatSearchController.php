<?php

namespace App\Http\Controllers\Api\Client;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Client\TripV2\StoreTalebatRequest;
use App\Http\Requests\Api\Client\Trip\TalebatSearchRequest;
use App\Http\Resources\Api\Client\Trip\CaptainModelResource;
use App\Http\Resources\Api\Client\Trip\DriverTripOfferResource;
use App\Http\Resources\Api\Client\Trip\TalebatSearchResource;
use App\Jobs\GenerateReportPDFJob;
use App\Models\DriverTripOffer;
use App\Models\Report;
use App\Models\Track;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Services\DriversActions;
use App\Support\Helper\MhelperClass;
use App\Trait\SearchTrait;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

# Talebat >>> Monthly Subescriptions الاشتراكات الشهرية
# Other   >>> Trips مشاوير
class TalebatSearchController extends ApiController
{
    use SearchTrait;

    public function search(TalebatSearchRequest $request, MhelperClass $helper)
    {
        # Dates as array
        $tripDatesArray = $this->tripDatesArray();
        if (empty($tripDatesArray)) {
            $message = __('messages.there_is_no_days_included_in_the_date_range');
            throw new HttpResponseException(sendError($message, ["can't search" => $message]));
        }
        # Draw radius around points
        $origin = $this->rad($request->origin["lat"], $request->origin["lng"], $request->tolerantFactor ?? 1);
        $destination = $this->rad($request->destination["lat"], $request->destination["lng"], $request->tolerantFactor ?? 1);
        # Prepare drivers or owners query builder
        $users = User::query()->whereIsActive(true);
        # loop through days to find available tracks
        foreach ($tripDatesArray as $day => $dates) {
            # collection of days
            $scheduledTimesByDay = $this->filterSchedulesByDay($request->repeat, $day);
            # continue query the drivers using the previously created builder $users
            $users = $users->whereHas("tracks", function ($q) use ($origin, $destination, $day) {
                $q->where(function ($query) {
                    $query->orWhereHas('driver', function ($query) {
                        $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                            ->where('is_active', true)->where('update_price', 0);
                    })->orWhereHas('owner', function ($query) {
                        $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                            ->where('is_active', true)->where('update_price', 0);
                    });
                })
                    ->where("tracks.is_active", true)
                    ->whereJsonContains("repeat", $day)
                    ->where(function ($q) use ($origin, $destination) {
                        $q->where(function ($q) use ($origin, $destination) {
                            $q->where(function ($qu) use ($origin) {
                                $qu->whereBetween("origin->lat", [$origin["minLat"], $origin["maxLat"]])
                                    ->whereBetween("origin->lng", [$origin["minLng"], $origin["maxLng"]])
                                    ->orWhereHas("waypoints", function ($que) use ($origin) {
                                        $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                    });
                            })
                                ->where(function ($qu) use ($destination) {
                                    $qu->whereBetween("destination->lat", [$destination["minLat"], $destination["maxLat"]])
                                        ->whereBetween("destination->lng", [$destination["minLng"], $destination["maxLng"]])
                                        ->orWhereHas("waypoints", function ($que) use ($destination) {
                                            $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                        });
                                });
                        })
                            ->orWhere(function ($q) use ($origin, $destination) {
                                $q->where(function ($qu) use ($origin) {
                                    $qu->whereBetween("destination->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("destination->lng", [$origin["minLng"], $origin["maxLng"]]);
                                    $qu->orWhereHas("waypoints", function ($que) use ($origin) {
                                        $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])
                                            ->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                    });
                                })
                                    ->where(function ($qu) use ($destination) {
                                        $qu->whereBetween("origin->lat", [$destination["minLat"], $destination["maxLat"]])
                                            ->whereBetween("origin->lng", [$destination["minLng"], $destination["maxLng"]])
                                            ->orWhereHas("waypoints", function ($que) use ($destination) {
                                                $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])
                                                    ->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                            });
                                    });
                            });
                    });
            })
                ->with(["tracks" => function ($q) use ($origin, $destination, $day) {
                    $q->whereHas("driver", function ($qu) {
                        return $qu->where("driver_license_end_date", ">", Carbon::now());
                    })
                        ->where("tracks.is_active", true)->whereJsonContains("repeat", $day)
                        ->where(function ($q) use ($origin, $destination) {
                            $q->where(function ($q) use ($origin, $destination) {
                                $q->where(function ($qu) use ($origin) {
                                    $qu->whereBetween("origin->lat", [$origin["minLat"], $origin["maxLat"]])
                                        ->whereBetween("origin->lng", [$origin["minLng"], $origin["maxLng"]])
                                        ->orWhereHas("waypoints", function ($que) use ($origin) {
                                            $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                        });
                                })
                                    ->where(function ($qu) use ($destination) {
                                        $qu->whereBetween("destination->lat", [$destination["minLat"], $destination["maxLat"]])
                                            ->whereBetween("destination->lng", [$destination["minLng"], $destination["maxLng"]])
                                            ->orWhereHas("waypoints", function ($que) use ($destination) {
                                                $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                            });
                                    });
                            })
                                ->orWhere(function ($q) use ($origin, $destination) {
                                    $q->where(function ($qu) use ($origin) {
                                        $qu->whereBetween("destination->lat", [$origin["minLat"], $origin["maxLat"]])
                                            ->whereBetween("destination->lng", [$origin["minLng"], $origin["maxLng"]])
                                            ->orWhereHas("waypoints", function ($que) use ($origin) {
                                                $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                            });
                                    })
                                        ->where(function ($qu) use ($destination) {
                                            $qu->whereBetween("origin->lat", [$destination["minLat"], $destination["maxLat"]])
                                                ->whereBetween("origin->lng", [$destination["minLng"], $destination["maxLng"]])
                                                ->orWhereHas("waypoints", function ($que) use ($destination) {
                                                    $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                                });
                                        });
                                });
                        });
                }]);
        }
        # get time ranges for each day default -30 before trip time and +30 after trip time
        [$goStartRange, $goEndRange] = $this->timeRange($scheduledTimesByDay["go"]);
        [$returnStartRange, $returnEndRange] = $this->timeRange($scheduledTimesByDay["return"]);
        # execute the builder then filter the response
        $users = $users->get()
            ->filter(function ($user) use ($helper, $origin, $destination, $goStartRange, $goEndRange, $returnStartRange, $returnEndRange) {
                $goingTrips = [];
                $returningTrips = [];
                $capacity = [];
                # if driver found filter his tracks
                $user->tracks->filter(function ($track) use ($helper, $origin, $destination, $goStartRange, $goEndRange, &$capacity, &$goingTrips, $returnStartRange, $returnEndRange, &$returningTrips) {
                    $clientTrack = [];
                    # add waypoints to origin and distantion
                    if ($track->waypoints()->count()) {
                        $waypoints = $track->waypoints->pluck("waypoint");
                    } else {
                        $waypoints = [];
                    }
                    $spreadTrack = collect([$track->origin, ...$waypoints, $track->destination]);
                    # search right track for the customer from origin to distantion
                    $spreadTrack->filter(function ($q) use ($origin, $destination, &$clientTrack, &$capacity, $track, $goStartRange, $goEndRange, $helper, &$goingTrips) {
                        if (!isset($clientTrack["origin"]) && $origin["minLat"] < +$q["lat"] && +$q["lat"] < $origin["maxLat"] && $origin["minLng"] < +$q["lng"] && +$q["lng"] < $origin["maxLng"]) {
                            $timeRangeOrigin = $helper->addTime($track->origin["start_time"], $q["duration"]);
                            $inOrigin = $timeRangeOrigin >= $goStartRange && $timeRangeOrigin <= $goEndRange;

                            if ($inOrigin)
                                $clientTrack["origin"] = $q;
                        }

                        if ($destination["minLat"] < +$q["lat"] && +$q["lat"] < $destination["maxLat"] && $destination["minLng"] < +$q["lng"] && +$q["lng"] < $destination["maxLng"] && isset($clientTrack["origin"])) {
                            if ($clientTrack["origin"] != $q) {
                                $clientTrack["destination"] = $q;
                            }
                        }

                        if (isset($clientTrack["origin"]) && isset($clientTrack["destination"])) {
                            $clientTrack["distance"] = number_format((int)$clientTrack["destination"]["distance"] - $clientTrack["origin"]["distance"], 2) ?? '0.00';
                            $clientTrack["start_time"] = $helper->addTime($track->origin["start_time"], $clientTrack["origin"]["duration"]);
                            $clientTrack["track_id"] = $track->id;

                            foreach ($this->tripDatesArray() as $day => $dates) {
                                $dayExistsInTrack = in_array($day, $track->repeat);
                                if ($dayExistsInTrack) {
                                    foreach ($dates as $date) {
                                        $occupaiedCapacity = Trip::whereTrackId($track->id)->where("date", $date)->whereNull('end_at')->count();
                                        //$vehicleCapacity = $track->vehicle->year->model->capacity;
                                        $vehicleCapacity = $track->vehicle?->year?->model?->capacity ?? 0;
                                        if ($vehicleCapacity > $occupaiedCapacity) {
                                            $clientTrack["date"] = $date;
                                            $goingTrips[$date] = $clientTrack;

                                            $capacity["vehicleCapacity"] = min([data_get($capacity, "vehicleCapacity", PHP_INT_MAX), $vehicleCapacity]);
                                            $capacity["validCapacity"] = min([data_get($capacity, "validCapacity", PHP_INT_MAX), $vehicleCapacity - $occupaiedCapacity]);
                                            $capacity["occupaiedCapacity"] = min([data_get($capacity, "occupaiedCapacity", PHP_INT_MAX), $occupaiedCapacity]);
                                        }
                                    }
                                }
                            }
                        }
                    });
                    # search right track for the customer from distantion to origin
                    $spreadTrack->filter(function ($q) use ($origin, $destination, &$clientTrack, &$capacity, $track, $returnStartRange, $returnEndRange, $helper, &$returningTrips) {
                        if (!isset($clientTrack["origin"]) && $destination["minLat"] < +$q["lat"] && +$q["lat"] < $destination["maxLat"] && $destination["minLng"] < +$q["lng"] && +$q["lng"] < $destination["maxLng"]) {

                            $timeRangeOrigin = $helper->addTime($track->origin["start_time"], $q["duration"]);
                            $inOrigin = $timeRangeOrigin >= $returnStartRange && $timeRangeOrigin <= $returnEndRange;

                            if ($inOrigin)
                                $clientTrack["origin"] = $q;
                        }

                        if ($origin["minLat"] < +$q["lat"] && +$q["lat"] < $origin["maxLat"] && $origin["minLng"] < +$q["lng"] && +$q["lng"] < $origin["maxLng"] && isset($clientTrack["origin"])) {
                            if ($clientTrack["origin"] != $q) {
                                $clientTrack["destination"] = $q;
                            }
                        }

                        if (isset($clientTrack["origin"]) && isset($clientTrack["destination"])) {
                            $clientTrack["distance"] = number_format((int)$clientTrack["destination"]["distance"] - $clientTrack["origin"]["distance"], 2) ?? '0.00';
                            $clientTrack["start_time"] = $helper->addTime($track->origin["start_time"], $clientTrack["origin"]["duration"]);
                            $clientTrack["track_id"] = $track->id;

                            foreach ($this->tripDatesArray() as $day => $dates) {
                                $dayExistsInTrack = in_array($day, $track->repeat);
                                if ($dayExistsInTrack) {
                                    foreach ($dates as $date) {
                                        $occupaiedCapacity = Trip::whereTrackId($track->id)->where("date", $date)->whereNull('end_at')->count();
                                        //$vehicleCapacity = $track->vehicle->year->model->capacity;
                                        $vehicleCapacity = $track->vehicle?->year?->model?->capacity ?? 0;
                                        if ($vehicleCapacity > $occupaiedCapacity) {
                                            $clientTrack["date"] = $date;
                                            $returningTrips[$date] = $clientTrack;

                                            $capacity["vehicleCapacity"] = min([data_get($capacity, "vehicleCapacity", PHP_INT_MAX), $vehicleCapacity]);
                                            $capacity["validCapacity"] = min([data_get($capacity, "validCapacity", PHP_INT_MAX), $vehicleCapacity - $occupaiedCapacity]);
                                            $capacity["occupaiedCapacity"] = min([data_get($capacity, "occupaiedCapacity", PHP_INT_MAX), $occupaiedCapacity]);
                                        };
                                    }
                                }
                            }
                        }
                    });
                });
                # if track data found return driver instance the $user associated with data built inside this statement
                if (count($goingTrips) == count($this->tripDatesArray(true)) && count($returningTrips) == count($this->tripDatesArray(true))) {
                    $user->trips = [...array_values($goingTrips), ...array_values($returningTrips)];
                    $user->totalKm = array_sum(collect($user->trips)->pluck("distance")->toArray());
                    $user->totalPrice = $user->totalKm * (request()->has("type") && request("type") == "talebat" ? $user->talebat_price : $user->other_price);
                    $user->vehicleCapacity = $capacity["vehicleCapacity"];
                    $user->validCapacity = $capacity["validCapacity"];
                    $user->occupaiedCapacity = $capacity["occupaiedCapacity"];
                    return $user;
                }
            });
        # if no driver means no tracks show error
        if ($users->isNotEmpty()) {
            return sendResponse(TalebatSearchResource::collection($users));
        } else {
            $users = $this->searchTracByDays($request, $helper);
            if ($users->isNotEmpty())
                return sendResponse(TalebatSearchResource::collection($users));
        }
        return sendError(__("messages.no_trips_found_at_this_time"), ["empty_search" => [__("messages.no_trips_found_at_this_time")]]);
    }

    /* -- old function --
    public function store(StoreTalebatRequest $request)
    {
        # GET LIST OF TRIP DATES
        $tripDates = $this->tripDates();
        $dates = [];

        foreach ($request->repeat as $repeat) {
            foreach ($tripDates as $date) {
                if ($repeat['day'] == Carbon::parse($date)->format('l')) {
                    $dates[] = [
                        'date' => $date, 'from' => $repeat['go'], 'to' => $repeat['return'], 'trip_type' => 'go'
                    ];
                }
            }
        }
        $dates = collect($dates)->sortByDesc('date')->reverse()->values()->toArray();

        $backDates = [];
        foreach ($dates as $date) {
            $backDates[] = [
                'date' => $date['date'],
                'from' => $date['to'],
                'to' => $date['to'],
                'trip_type' => 'return',
            ];
        }

        $fullDates = [...$dates, ...$backDates];
        $fullDates = collect($fullDates)->sortByDesc(['date', 'from'])->values()->toArray();

        # CALCULATE PRICE
        $trips = array();
        $priceType = $request->type == "talebat" ? "talebat_price" : "other_price";
        // foreach ($request->tracks as $track) {
        $tax = data_get(setting('tax'), "tax", 14);
        // $kmPrice = Track::whereId($track['track_id'] ?? null)->first()->owner->$priceType;
        // $subtotal = $track['distance'] * $kmPrice;
        $subtotal = 0;
        $distance = (new DriversActions())->calcDistance(
            $request->origin['lat'],
            $request->origin['lng'],
            $request->destination['lat'],
            $request->destination['lng'],
        );
            $parent_id = 0;
            # GENERATE TRIPS
            foreach ($fullDates as $tripDate) {
                $newTrip = Trip::create([
                    'client_id' => auth()->id(),
                    'date' => Carbon::parse($tripDate['date'])->format('Y-m-d'),
                    'time' => $tripDate['from'],
                    'trip_type' => $tripDate['trip_type'],
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'parent_id' => $parent_id
                ]);
                if (!$parent_id) {
                    $parent_id = $newTrip->id;
                }
                if ($newTrip->wasRecentlyCreated) {
                    $trips[] = $newTrip;
                }
            }
            $report = null;
            if (!empty($trips)) {
                # GENERATE REPORT
                $report = Report::create([
                    "total_km" => $distance["distance"],
                    "duration" => $distance["duration"],
                    "sub_total" => $subtotal,
                    "tax_value" => 0,
                    "tax" => $tax,
                    "total" => 0,
                    "km_price" => 0,
                    "payment_method" => 'not paid',
                    "reservation_type" => $request->type,
                    "start_date" => $request->start_date,
                    "end_date" => $request->end_date,
                    "accepted_time_for_driver" => now()->format('Y-m-d H:i:s'),
                ]);
            }
            // LINK TRIPS TO REPORT
            foreach ($trips as $trip) {
                $trip->update([
                    'report_id' => $report->id,
                ]);

                $trip->chat()->updateOrCreate([
                    'trip_id' => $trip->id
                ], [
                    'sender_id' => auth()->id(),
                    'receiver_id' => 0
                ]);
            }

        $user = $request->user()->load('deviceTokens');
        $allActiveDrivers = (new DriversActions())->nearestDrivers($trip->origin['lat'], $trip->origin['lng'], $trip);
        if(count($trips) == count($fullDates)){
            $firstTrip = reset($trips);
            $user->notify(new FcmNotification(
                $user->sendableTokens,
                ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')],
                ['ar' => __("messages.you_purchased_new_trips", [], 'ar'),
                    'en' => __("messages.you_purchased_new_trips", [], 'en')],
                FCMTopic::CLIENT_TALEBAT_NEW_TRIPS,
                FCMAction::CLIENT_OPEN_NEW_TRIPS,
                $firstTrip->id,
            ));

            foreach ($allActiveDrivers as $driver) {
                $driver?->notify(new FcmNotification(
                    $driver?->sendableTokens,
                    ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                        'en' => __("messages.you_have_new_notification", [], 'en')],
                    ['ar' => __("messages.client_purchased_new_trips",[], 'ar'),
                        'en' => __("messages.client_purchased_new_trips",[], 'en')],
                    FCMTopic::DRIVER_TRIP_BOOKED,
                    FCMAction::DRIVER_OPEN_NEW_TRIPS,
                    $driver->id
                ));
            }
        }
     
        return sendResponse(__("messages.resource_created"));

    }
    */

    /* -- new function by neila */
    public function store(StoreTalebatRequest $request)
    {
        try {
            if (!$request->origin || !$request->destination || !is_array($request->repeat)) {
                return sendError("Invalid request data");
            }

            $tripDates = $this->tripDates();
            if (empty($tripDates)) {
                return sendError(__('messages.there_is_no_days_included_in_the_date_range'));
            }

            $dates = [];

            foreach (($request->repeat ?? []) as $repeat) {
                foreach (($tripDates ?? []) as $date) {
                    try {
                        if (($repeat['day'] ?? null) === Carbon::parse($date)->format('l')) {
                            $dates[] = [
                                'date' => $date,
                                'from' => $repeat['go'] ?? null,
                                'to' => $repeat['return'] ?? null,
                                'trip_type' => 'go'
                            ];
                        }
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }

            $dates = collect($dates)->sortBy('date')->values()->toArray();

            $backDates = [];

            foreach ($dates as $date) {
                $backDates[] = [
                    'date' => $date['date'] ?? null,
                    'from' => $date['to'] ?? null,
                    'to' => $date['to'] ?? null,
                    'trip_type' => 'return',
                ];
            }

            $fullDates = array_merge($dates, $backDates);
            $fullDates = collect($fullDates)->sortBy(['date', 'from'])->values()->toArray();

            $trips = [];
            $tax = data_get(setting('tax'), 'tax', 14);

            $distance = (new DriversActions())->calcDistance(
                data_get($request->origin, 'lat'),
                data_get($request->origin, 'lng'),
                data_get($request->destination, 'lat'),
                data_get($request->destination, 'lng'),
            );

            $subtotal = 0;
            $parent_id = 0;


            /**
             * PRICING (FIXED — THIS WAS YOUR BUG)
             */
            $taxRate = data_get(setting('tax'), 'tax', 14);

            $priceType = $request->type === "talebat"
                ? "talebat_price"
                : "other_price";

            $user = auth()->user();

            $kmPrice = $user->$priceType ?? 0;

            $subtotal = ($distance['distance'] ?? 0) * $kmPrice;

            $taxValue = ($subtotal * $taxRate) / 100;
            $total = $subtotal + $taxValue;


            foreach ($fullDates as $tripDate) {

                if (!($tripDate['date'] ?? false)) {
                    continue;
                }

                $newTrip = Trip::create([
                    'client_id' => auth()->id(),
                    'date' => Carbon::parse($tripDate['date'])->format('Y-m-d'),
                    'time' => $tripDate['from'] ?? null,
                    'trip_type' => $tripDate['trip_type'] ?? 'go',
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'parent_id' => $parent_id
                ]);

                if (!$parent_id) {
                    $parent_id = $newTrip->id;
                }

                if ($newTrip) {
                    $trips[] = $newTrip;
                }
            }

            $report = null;

            if (count($trips) > 0) {
                $report = Report::create([
                    "total_km" => data_get($distance, 'distance', 0),
                    "duration" => data_get($distance, 'duration', 0),
                    "sub_total" => $subtotal,
                    "tax_value" => $taxValue,
                    "tax" => $taxRate,
                    "total" => $total,
                    "km_price" => $kmPrice,
                    "payment_method" => 'not paid',
                    "reservation_type" => $request->type,
                    "start_date" => $request->start_date ?? null,
                    "end_date" => $request->end_date ?? null,
                    "accepted_time_for_driver" => now(),
                ]);
            }

            foreach ($trips as $trip) {
                if ($report) {
                    $trip->update(['report_id' => $report->id]);
                }

                $trip->chat()->updateOrCreate(
                    ['trip_id' => $trip->id],
                    [
                        'sender_id' => auth()->id(),
                        'receiver_id' => 0
                    ]
                );
            }

            $user = $request->user()->load('deviceTokens');

            $firstTrip = $trips[0] ?? null;

            $allActiveDrivers = collect();

            if ($firstTrip && is_array($firstTrip->origin ?? null)) {
                $allActiveDrivers = (new DriversActions())->nearestDrivers(
                    data_get($firstTrip->origin, 'lat'),
                    data_get($firstTrip->origin, 'lng'),
                    $firstTrip
                );
            }

            if (count($trips) === count($fullDates) && $firstTrip) {

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
                    FCMTopic::CLIENT_TALEBAT_NEW_TRIPS,
                    FCMAction::CLIENT_OPEN_NEW_TRIPS,
                    $firstTrip->id,
                ));

                foreach ($allActiveDrivers as $driver) {
                    $driver?->notify(new FcmNotification(
                        $driver?->sendableTokens,
                        [
                            'ar' => __("messages.you_have_new_notification", [], 'ar'),
                            'en' => __("messages.you_have_new_notification", [], 'en')
                        ],
                        [
                            'ar' => __("messages.client_purchased_new_trips", [], 'ar'),
                            'en' => __("messages.client_purchased_new_trips", [], 'en')
                        ],
                        FCMTopic::DRIVER_TRIP_BOOKED,
                        FCMAction::DRIVER_OPEN_NEW_TRIPS,
                        $driver->id
                    ));
                }
            }

            return sendResponse(__("messages.resource_created"));

        } catch (\Throwable $e) {
            return sendError("Server error", [
                "message" => $e->getMessage(),
                "line" => $e->getLine()
            ]);
        }
    }

    public function getRequestedDrivers(Trip $trip)
    {
        if ($trip->report?->reservation_type == 'other') {
            return sendError(__('messages.the trip type must be talebat'));
        }

        $tripOffers = $trip->driverTripOffers()
            ->with('driver')
            ->where('status', 'pending')
            ->get()
            ->map(function ($tripOffer) use ($trip) {

                $distance = (new DriversActions())->calcDistance(
                    $trip->origin['lat'],
                    $trip->origin['lng'],
                    $trip->destination['lat'],
                    $trip->destination['lng'],
                );

                $kmPrice = $tripOffer->driver?->driverOrg ? $tripOffer->driver?->driverOrg?->talebat_price : $tripOffer->driver?->talebat_price;
                $subtotal = $distance['distance'] * $kmPrice * ($trip?->children()->count() + 1);
                $taxPercentage = (double)setting('general', "tax", 14);
                $total = $subtotal + ($subtotal * $taxPercentage / 100);
                $tripOffer->driver->tripTotal = $total;

                return $tripOffer;
            });
        return sendResponse(DriverTripOfferResource::collection($tripOffers));
    }

    public function acceptedDriverOnTalebatTrip(Trip $trip, User $user)
    {
        $offer = $trip->driverTripOffers()
            ->where('driver_id', $user->id)
            ->where('status', 'pending')
            ->first();
        if (!$offer) {
            return sendError(__("messages.there is no offer for this driver on this trip"));
        }

        DB::beginTransaction();

        $offer->update(['status' => 'accepted']);
        $trip->update(['driver_id' => $user->id]);
        $trip->children()->update(['driver_id' => $user->id]);

        // $distance = (new DriversActions())->calcDistance(
        //     $trip->origin['lat'],
        //     $trip->origin['lng'],
        //     $trip->destination['lat'],
        //     $trip->destination['lng'],
        // );

        $kmPrice = $user->driverOrg ? $user->driverOrg?->talebat_price : $user->talebat_price;
        $subtotal = $trip?->report?->total_km * $kmPrice * ($trip->children()->count() + 1);

        $taxPercentage = (double)setting('general', "tax", 14);

        $trip->report()?->update([
            // 'total_km' => $distance['distance'],
            "sub_total" => $subtotal,
            "tax_value" => ($subtotal * $taxPercentage) / 100,
            "tax" => $taxPercentage,
            "total" => $subtotal + (($subtotal * $taxPercentage) / 100),
            "km_price" => $kmPrice,
            "accepted_time" => now()->format('Y-m-d H:i:s'),
        ]);

        $trip->chat()->updateOrCreate([
            'trip_id' => $trip->id,
            'sender_id' => $trip->client?->id,
        ], [
            'receiver_id' => $user->id
        ]);

        foreach ($trip->children as $child) {
            $child->chat()->updateOrCreate([
                'trip_id' => $child->id,
                'sender_id' => $child->client?->id,
            ], [
                'receiver_id' => $user->id
            ]);
        }

        DB::commit();

        Notification::send($user, new FcmNotification(
            $user?->deviceTokens?->pluck('token')->toArray(),
            ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')],
            ['ar' => __("messages.you accepted fro client on trip :trip", ['trip' => $trip->id],'ar'),
                'en' => __("messages.you accepted fro client on trip :trip", ['trip' => $trip->id],'en')],
            FCMTopic::DRIVER_TRIP_BOOKED,
            FCMAction::DRIVER_OPEN_UPCOMING_TRIPS,
            $trip?->id,
        ));

        return sendResponse(message: __('messages.driver :driver is accepted', ['driver' => $user->name]));

    }


    public function searchTracByDays(TalebatSearchRequest $request, MhelperClass $helper)
    {
        # Dates as array
        $tripDatesArray = $this->tripDatesArray();
        if (empty($tripDatesArray)) {
            $message = __('messages.there_is_no_days_included_in_the_date_range');
            throw new HttpResponseException(sendError($message, ["can't search" => $message]));
        }
        # Draw radius around points
        $origin = $this->rad($request->origin["lat"], $request->origin["lng"], $request->tolerantFactor ?? 1);
        $destination = $this->rad($request->destination["lat"], $request->destination["lng"], $request->tolerantFactor ?? 1);
        # Prepare drivers or owners query builder
        $users = User::query()->whereIsActive(true);
        # loop through days to find available tracks
        foreach ($tripDatesArray as $day => $dates) {
            # collection of days
            $scheduledTimesByDay = $this->filterSchedulesByDay($request->repeat, $day);
            # continue query the drivers using the previously created builder $users
            $users = $users->whereHas("tracks", function ($q) use ($origin, $destination, $day) {
                $q->where(function ($query) {
                    $query->orWhereHas('driver', function ($query) {
                        $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                            ->where('is_active', true)->where('update_price', 0);
                    })->orWhereHas('owner', function ($query) {
                        $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                            ->where('is_active', true)->where('update_price', 0);
                    });
                })
                    ->where("tracks.is_active", true)
                    ->whereJsonContains("repeat", $day)
                    ->where(function ($q) use ($origin, $destination) {
                        $q->where(function ($q) use ($origin, $destination) {
                            $q->where(function ($qu) use ($origin) {
                                $qu->whereBetween("origin->lat", [$origin["minLat"], $origin["maxLat"]])
                                    ->whereBetween("origin->lng", [$origin["minLng"], $origin["maxLng"]])
                                    ->orWhereHas("waypoints", function ($que) use ($origin) {
                                        $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                    });
                            })
                                ->where(function ($qu) use ($destination) {
                                    $qu->whereBetween("destination->lat", [$destination["minLat"], $destination["maxLat"]])
                                        ->whereBetween("destination->lng", [$destination["minLng"], $destination["maxLng"]])
                                        ->orWhereHas("waypoints", function ($que) use ($destination) {
                                            $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                        });
                                });
                        })
                            ->orWhere(function ($q) use ($origin, $destination) {
                                $q->where(function ($qu) use ($origin) {
                                    $qu->whereBetween("destination->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("destination->lng", [$origin["minLng"], $origin["maxLng"]]);
                                    $qu->orWhereHas("waypoints", function ($que) use ($origin) {
                                        $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])
                                            ->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                    });
                                })
                                    ->where(function ($qu) use ($destination) {
                                        $qu->whereBetween("origin->lat", [$destination["minLat"], $destination["maxLat"]])
                                            ->whereBetween("origin->lng", [$destination["minLng"], $destination["maxLng"]])
                                            ->orWhereHas("waypoints", function ($que) use ($destination) {
                                                $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])
                                                    ->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                            });
                                    });
                            });
                    });
            })
                ->with(["tracks" => function ($q) use ($origin, $destination, $day) {
                    $q->whereHas("driver", function ($qu) {
                        return $qu->where("driver_license_end_date", ">", Carbon::now());
                    })
                        ->where("tracks.is_active", true)->whereJsonContains("repeat", $day)
                        ->where(function ($q) use ($origin, $destination) {
                            $q->where(function ($q) use ($origin, $destination) {
                                $q->where(function ($qu) use ($origin) {
                                    $qu->whereBetween("origin->lat", [$origin["minLat"], $origin["maxLat"]])
                                        ->whereBetween("origin->lng", [$origin["minLng"], $origin["maxLng"]])
                                        ->orWhereHas("waypoints", function ($que) use ($origin) {
                                            $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                        });
                                })
                                    ->where(function ($qu) use ($destination) {
                                        $qu->whereBetween("destination->lat", [$destination["minLat"], $destination["maxLat"]])
                                            ->whereBetween("destination->lng", [$destination["minLng"], $destination["maxLng"]])
                                            ->orWhereHas("waypoints", function ($que) use ($destination) {
                                                $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                            });
                                    });
                            })
                                ->orWhere(function ($q) use ($origin, $destination) {
                                    $q->where(function ($qu) use ($origin) {
                                        $qu->whereBetween("destination->lat", [$origin["minLat"], $origin["maxLat"]])
                                            ->whereBetween("destination->lng", [$origin["minLng"], $origin["maxLng"]])
                                            ->orWhereHas("waypoints", function ($que) use ($origin) {
                                                $que->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                                            });
                                    })
                                        ->where(function ($qu) use ($destination) {
                                            $qu->whereBetween("origin->lat", [$destination["minLat"], $destination["maxLat"]])
                                                ->whereBetween("origin->lng", [$destination["minLng"], $destination["maxLng"]])
                                                ->orWhereHas("waypoints", function ($que) use ($destination) {
                                                    $que->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                                                });
                                        });
                                });
                        });
                }]);
        }
        # get time ranges for each day default -30 before trip time and +30 after trip time
        [$goStartRange, $goEndRange] = $this->timeRange($scheduledTimesByDay["go"]);
        [$returnStartRange, $returnEndRange] = $this->timeRange($scheduledTimesByDay["return"]);
        # execute the builder then filter the response
        $users = $users->get()
            ->filter(function ($user) use ($helper, $origin, $destination, $goStartRange, $goEndRange, $returnStartRange, $returnEndRange) {
                $goingTrips = [];
                $returningTrips = [];
                $capacity = [];
                # if driver found filter his tracks
                $user->tracks->filter(function ($track) use ($helper, $origin, $destination, $goStartRange, $goEndRange, &$capacity, &$goingTrips, $returnStartRange, $returnEndRange, &$returningTrips) {
                    $clientTrack = [];
                    # add waypoints to origin and distantion
                    if ($track->waypoints()->count()) {
                        $waypoints = $track->waypoints->pluck("waypoint");
                    } else {
                        $waypoints = [];
                    }
                    $spreadTrack = collect([$track->origin, ...$waypoints, $track->destination]);
                    # search right track for the customer from origin to distantion
                    $spreadTrack->filter(function ($q) use ($origin, $destination, &$clientTrack, &$capacity, $track, $goStartRange, $goEndRange, $helper, &$goingTrips) {
                        if (!isset($clientTrack["origin"]) && $origin["minLat"] < +$q["lat"] && +$q["lat"] < $origin["maxLat"] && $origin["minLng"] < +$q["lng"] && +$q["lng"] < $origin["maxLng"]) {
                            $clientTrack["origin"] = $q;
                        }

                        if ($destination["minLat"] < +$q["lat"] && +$q["lat"] < $destination["maxLat"] && $destination["minLng"] < +$q["lng"] && +$q["lng"] < $destination["maxLng"] && isset($clientTrack["origin"])) {
                            if ($clientTrack["origin"] != $q) {
                                $clientTrack["destination"] = $q;
                            }
                        }

                        if (isset($clientTrack["origin"]) && isset($clientTrack["destination"])) {
                            $clientTrack["distance"] = number_format((int)$clientTrack["destination"]["distance"] - $clientTrack["origin"]["distance"], 2) ?? '0.00';
                            $clientTrack["start_time"] = $helper->addTime($track->origin["start_time"], $clientTrack["origin"]["duration"]);
                            $clientTrack["track_id"] = $track->id;

                            foreach ($this->tripDatesArray() as $day => $dates) {
                                $dayExistsInTrack = in_array($day, $track->repeat);
                                if ($dayExistsInTrack) {
                                    foreach ($dates as $date) {
                                        $occupaiedCapacity = Trip::whereTrackId($track->id)->where("date", $date)->whereNull('end_at')->count();
                                        //$vehicleCapacity = $track->vehicle->year->model->capacity;
                                        $vehicleCapacity = $track->vehicle?->year?->model?->capacity ?? 0;
                                        if ($vehicleCapacity > $occupaiedCapacity) {
                                            $clientTrack["date"] = $date;
                                            $goingTrips[$date] = $clientTrack;

                                            $capacity["vehicleCapacity"] = min([data_get($capacity, "vehicleCapacity", PHP_INT_MAX), $vehicleCapacity]);
                                            $capacity["validCapacity"] = min([data_get($capacity, "validCapacity", PHP_INT_MAX), $vehicleCapacity - $occupaiedCapacity]);
                                            $capacity["occupaiedCapacity"] = min([data_get($capacity, "occupaiedCapacity", PHP_INT_MAX), $occupaiedCapacity]);
                                        }
                                    }
                                }
                            }
                        }
                    });
                    # search right track for the customer from distantion to origin
                    $spreadTrack->filter(function ($q) use ($origin, $destination, &$clientTrack, &$capacity, $track, $returnStartRange, $returnEndRange, $helper, &$returningTrips) {
                        if (!isset($clientTrack["origin"]) && $destination["minLat"] < +$q["lat"] && +$q["lat"] < $destination["maxLat"] && $destination["minLng"] < +$q["lng"] && +$q["lng"] < $destination["maxLng"]) {
                            $clientTrack["origin"] = $q;
                        }

                        if ($origin["minLat"] < +$q["lat"] && +$q["lat"] < $origin["maxLat"] && $origin["minLng"] < +$q["lng"] && +$q["lng"] < $origin["maxLng"] && isset($clientTrack["origin"])) {
                            if ($clientTrack["origin"] != $q) {
                                $clientTrack["destination"] = $q;
                            }
                        }

                        if (isset($clientTrack["origin"]) && isset($clientTrack["destination"])) {
                            $clientTrack["distance"] = number_format((int)$clientTrack["destination"]["distance"] - $clientTrack["origin"]["distance"], 2) ?? '0.00';
                            $clientTrack["start_time"] = $helper->addTime($track->origin["start_time"], $clientTrack["origin"]["duration"]);
                            $clientTrack["track_id"] = $track->id;

                            foreach ($this->tripDatesArray() as $day => $dates) {
                                $dayExistsInTrack = in_array($day, $track->repeat);
                                if ($dayExistsInTrack) {
                                    foreach ($dates as $date) {
                                        $occupaiedCapacity = Trip::whereTrackId($track->id)->where("date", $date)->whereNull('end_at')->count();
                                        //$vehicleCapacity = $track->vehicle->year->model->capacity;
                                        $vehicleCapacity = $track->vehicle?->year?->model?->capacity ?? 0;
                                        if ($vehicleCapacity > $occupaiedCapacity) {
                                            $clientTrack["date"] = $date;
                                            $returningTrips[$date] = $clientTrack;

                                            $capacity["vehicleCapacity"] = min([data_get($capacity, "vehicleCapacity", PHP_INT_MAX), $vehicleCapacity]);
                                            $capacity["validCapacity"] = min([data_get($capacity, "validCapacity", PHP_INT_MAX), $vehicleCapacity - $occupaiedCapacity]);
                                            $capacity["occupaiedCapacity"] = min([data_get($capacity, "occupaiedCapacity", PHP_INT_MAX), $occupaiedCapacity]);
                                        };
                                    }
                                }
                            }
                        }
                    });
                });
                # if track data found return driver instance the $user associated with data built inside this statement
                if (count($goingTrips) == count($this->tripDatesArray(true)) && count($returningTrips) == count($this->tripDatesArray(true))) {
                    $user->trips = [...array_values($goingTrips), ...array_values($returningTrips)];
                    $user->totalKm = array_sum(collect($user->trips)->pluck("distance")->toArray());
                    $user->totalPrice = $user->totalKm * (request()->has("type") && request("type") == "talebat" ? $user->talebat_price : $user->other_price);
                    $user->vehicleCapacity = $capacity["vehicleCapacity"];
                    $user->validCapacity = $capacity["validCapacity"];
                    $user->occupaiedCapacity = $capacity["occupaiedCapacity"];
                    return $user;
                }
            });
        # if no driver means no tracks show error
        return $users;
    }
}
