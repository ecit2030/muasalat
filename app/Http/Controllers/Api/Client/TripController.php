<?php

namespace App\Http\Controllers\Api\Client;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Client\Trip\RateTripRequest;
use App\Http\Requests\Api\Client\Trip\SearchTripRequest;
use App\Http\Requests\Api\Client\Trip\StoreTripRequest;
use App\Http\Resources\Api\Client\Trip\SearchTripResource;
use App\Http\Resources\Api\Client\Trip\TripResource;
use App\Jobs\GenerateReportPDFJob;
use App\Models\Report;
use App\Models\Track;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Support\Helper\MhelperClass;
use App\Trait\SearchTrait;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends ApiController
{
    use SearchTrait;

    public function index(Request $request)
    {
        $filter = isset($request->filter) ? $request->filter : "current";
        $data = Trip::query()
            ->whereClientId(auth()->id())
            ->whereHas('report')
            ->orderByDesc("date")
            ->when($filter == 'previous', function ($q) {
                return $q->whereNotNull("start_at")->whereNotNull("end_at")->with("track", function ($qu) {
                    return $qu->with('waypoints')->withoutRoute();
                });
            })->when($filter == 'current', function ($q) {
                return $q->whereNotNull("start_at")->whereNull("end_at")->with("track.waypoints");
            })->when($filter == 'upcoming', function ($q) {
                $currentTime = now()->format('H:i');
                $currentDate = now()->toDateString();
                return $q->whereNull("start_at")->whereNull("end_at")
                    ->orWhere(function ($query) use ($currentTime, $currentDate) {
                        $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) > ? AND date = ? AND client_id = ?", [$currentTime, $currentDate, auth()->id()]);
                    })
                    ->with("track", function ($qu) {
                        return $qu->with('waypoints')->withoutRoute();
                    });
            })
            ->get()
            ->each(function ($trip) use ($filter) {
                $trip->status = $filter;
                return $trip;
            });

        return sendResponse(TripResource::collection($data));
    }

    public function show(Trip $Trip)
    {
        $Trip->load(['report', 'track' => ['driver', 'owner']]);
        return sendResponse(new TripResource($Trip));
    }

    public function store(StoreTripRequest $request, MhelperClass $helper)
    {
        # GET LIST OF TRIP DATES
        $tripDates = $this->tripDates()->toArray();
        # FIND TRACK
        $track = Track::whereId($request->track_id)->with("waypoints")->first();
        # CHECK IF TODAY DATE IN LIST OF TRIP DATES
        $index = array_search(Carbon::today()->format('Y-m-d'), $tripDates);
        $check1 = is_numeric($index);
        # CHECK IF CURRENT TIME IS LARGER THAN START TIME OF ORIGIN POINT IN TRACK
        $check2 = Carbon::now()->format('H:i') > $track->origin["start_time"];
        # RESPONSE TO USER THAT HE CANNOT PURCHASE THIS TRIP
        if ($check1 && $check2) {
            unset($tripDates[$index]);
            if (count($tripDates) == 0) {
                $message = t_("you cant purshase one trip that started eariler");
                throw new HttpResponseException(sendError($message, ["purshase error" => [$message]]));
            }
        }
        # GET CLIENT TRACK
        $track = collect([$track->origin, ...$track->waypoints->pluck("waypoint"), $track->destination]);
        $clientTrack = [];
        $originRange = $this->rad($request->origin["lat"], $request->origin["lng"]);
        $destinationRange = $this->rad($request->destination["lat"], $request->destination["lng"]);
        $track->filter(function ($q) use ($originRange, $destinationRange, &$clientTrack, $helper) {
            if (!isset($clientTrack["origin"]) && $originRange["minLat"] < +$q["lat"] && +$q["lat"] < $originRange["maxLat"] && $originRange["minLng"] < +$q["lng"] && +$q["lng"] < $originRange["maxLng"]) {
                $clientTrack["origin"] = $q;
            }
            if ($destinationRange["minLat"] < +$q["lat"] && +$q["lat"] < $destinationRange["maxLat"] && $destinationRange["minLng"] < +$q["lng"] && +$q["lng"] < $destinationRange["maxLng"] && $clientTrack["origin"] != $q) {
                $clientTrack["destination"] = $q;
                $clientTrack["destination"]["duration"] = $helper->subTime($q["duration"], $clientTrack["origin"]["duration"]);
                $clientTrack["destination"]["distance"] = (string)+$q["distance"] - +$clientTrack["origin"]["distance"];
                $clientTrack["origin"]["duration"] = "00:00";
                $clientTrack["origin"]["distance"] = "0";
                $clientTrack["distance"] = $clientTrack["destination"]["distance"] - $clientTrack["origin"]["distance"];
            }
            return $clientTrack;
        });
        if (!isset($clientTrack["origin"]) || !isset($clientTrack["destination"])) {
            $message = t_("user origin or destination doesnt exist on this track");
            throw new HttpResponseException(sendError($message, ["track" => [$message]]));
        }
        # CALCULATE PRICE
        $priceType = $request->type == "talebat" ? "talebat_price" : "other_price";
        $tax = data_get(setting('tax'), "tax", 14);
        $trackRecord = Track::whereId($request->track_id)->with('owner.deviceTokens')->first();
        $kmPrice = $trackRecord?->owner?->$priceType;
        $subtotal = $clientTrack["distance"] * $kmPrice;
        $trips = array();
        $isStored = DB::transaction(function () use ($clientTrack, $subtotal, $tax, $kmPrice, $request, $tripDates, &$trips) {
            # GENERATE TRIPS
            foreach ($tripDates as $tripDate) {
                $occupaidCapacity = Trip::whereId($request->track_id)->where("date", $tripDate)->count();
                $validCapacity = Track::find($request->track_id)->vehicle->year->model->capacity;
                if ($validCapacity > $occupaidCapacity) {
                    $trips[] = Trip::create([
                        'track_id' => $request->track_id,
                        'client_id' => auth()->id(),
                        'origin' => $clientTrack["origin"],
                        'destination' => $clientTrack["destination"],
                        'date' => $tripDate
                    ]);
                }
            }
            $report = null;
            if (!empty($trips)) {
                # GENERATE REPORT
                $report = Report::create([
                    "total_km" => $clientTrack["distance"],
                    "sub_total" => $subtotal,
                    "tax_value" => $tax,
                    "tax" => ($subtotal * $tax) / 100,
                    "total" => $subtotal + (($subtotal * (1 + $tax)) / 100),
                    "km_price" => $kmPrice,
                    "reservation_type" => $request->type
                ]);
                # LINK TRIPS TO REPORT
                foreach ($trips as $trip) {
                    $trip->update([
                        'report_id' => $report->id,
                    ]);
                }
                $currentBalance = Track::whereId($request->track_id)->first()->owner->balance;
                Track::whereId($request->track_id)->first()->owner->update([
                    'balance' => $currentBalance + $subtotal,
                ]);
                # https://github.com/sparksuite/simple-html-invoice-template
                $report->loadMissing('trips.track');
                $locale = app()->getLocale();
                $appname = __('Muasalat', [], $locale);
                $address = __('address', [], $locale);
                $user = $request->user();
                dispatch(new GenerateReportPDFJob($report, $locale, $appname, $address, $user))->onConnection('database');
            }
            return !is_null($report) ? true : false;
        });
        if (!$isStored) {
            return sendResponse(__("messages.failed"));
        }
        # NOTIFY CLIENTS
        $user = $request->user()->load('deviceTokens');
        $firstTrip = empty($trips) ? null : reset($trips);
        $user->notify(new FcmNotification(
            $user->sendableTokens,
            t_("messages.you_have_new_notification"),
            t_("messages.you_purchased_new_trips"),
            FCMTopic::CLIENT_OTHER_TRIP,
            FCMAction::CLIENT_OPEN_NEW_TRIPS,
            is_null($firstTrip) ? null : $firstTrip->id,
        ));
        $trackRecord?->owner?->notify(new FcmNotification(
            $trackRecord?->owner?->sendableTokens,
            t_("messages.you_have_new_notification"),
            t_("messages.client_purchased_new_trips"),
            FCMTopic::DRIVER_TRIP_BOOKED,
            FCMAction::DRIVER_OPEN_UPCOMING_TRIPS,
            $trackRecord?->id,
        ));
        return sendResponse(__("messages.resource_created"));
    }

    public function rateTrip(RateTripRequest $request, Trip $trip)
    {
        $trip->load(['track' => ["owner.deviceTokens", "driver.deviceTokens"]]);
        
        tap($trip)->update($request->validated())->fresh();

        $orgOrCapTrips = Trip::select(["id", "track_id", "owner_id", "rate"])->where('rate', '>', 0)->whereHas("track", function ($q) use ($trip) {
            $q->whereHas("owner", function ($qu) use ($trip) {
                return $qu->whereId($trip->track?->owner_id);
            });
        });

        $orgOrCapRate = number_format($orgOrCapTrips->avg("rate"), 2, '.', '');

        tap($trip->track?->owner)->update([
            "rate" => $orgOrCapRate
        ])->fresh();

        // captain or org
        $tokens = $trip->track?->owner?->sendableTokens;
        $trip->track?->owner?->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("trip") . " " . $trip->track?->name . " " . t_("has_been_rated_by") . " " . $request->user()->name . " " . request("rate"), FCMTopic::OWNER_TRIP_RATED, FCMAction::OWNER_TRIP_RATED, $trip->id));

        // admins
        $admins = User::role("admin")->with(['deviceTokens'])->get();
        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("trip") . " " . $trip->track?->name . " " . t_("has_been_rated_by") . " " . $request->user()->name . " " . request("rate"), FCMTopic::ADMIN_TRIP_RATED, FCMAction::ADMIN_TRIP_RATED));
        }

        $driverTrips = Trip::select(["id", "track_id", "driver_id", "rate"])->where('rate', '>', 0)->whereHas("track", function ($q) use ($trip) {
            $q->whereHas("driver", function ($qu) use ($trip) {
                return $qu->whereId($trip->track?->driver_id);
            });
        });

        $driverRate = number_format($driverTrips->avg("rate"), 2, '.', '');

        tap($trip->track?->driver)->update([
            "rate" => $driverRate
        ])->fresh();

        return sendResponse(new TripResource($trip));
    }

    public function search(SearchTripRequest $request, MhelperClass $helper)
    {
        $tripDates = $this->tripDates()->toArray();
        if (empty($tripDates)) {
            $message = __('messages.there_is_no_days_included_in_the_date_range');
            throw new HttpResponseException(sendError($message, ["can't search" => $message]));
        }
        //        $index = array_search(Carbon::today()->format('Y-m-d'), $tripDates);
        //        $check1 = is_numeric($index);
        //        $check2 = Carbon::now()->format('H:i') > $request->time;
        //        if (count($tripDates) == 1 && $check1 && $check2) {
        //            $message = t_("you search in one trip that started eariler");
        //            throw new HttpResponseException(sendError($message, ["search error" => [$message]]));
        //        }

        $origin = $this->rad($request->origin["lat"], $request->origin["lng"]);
        $destination = $this->rad($request->destination["lat"], $request->destination["lng"]);

        # Not Started Trips to neglict double reservations
        $neglictedTrackIds = Trip::query()->whereClientId($request->user()->id)->whereNull('start_at')->whereDate('date', Carbon::parse($tripDates[0])->toDateString())->pluck('track_id')->toArray();
        // check if there are track have the client desired origin
        $startLocation = Track::query()
            ->where(function ($query) {
                $query->orWhereHas('driver', function ($query) {
                    $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                        ->where('is_active', true)->where('update_price', 0);
                })->orWhereHas('owner', function ($query) {
                    $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                        ->where('is_active', true)->where('update_price', 0);
                });
            })
            ->whereNotIn('id', $neglictedTrackIds)
            ->whereIsActive(true)->whereJsonContains("repeat", $request->repeat)
            ->where(function ($q) use ($origin) {
                $q->whereBetween("origin->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("origin->lng", [$origin["minLng"], $origin["maxLng"]]);
                $q->orWhereHas("waypoints", function ($qu) use ($origin) {
                    $qu->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                });
            })->get();

        //        if ($startLocation->count() == 0) {
        //            if (!empty($neglictedTrackIds) && count($neglictedTrackIds) > 0)
        //                return sendError(__("messages.already_booked_trip"), ["already_booked" => [__("messages.already_booked_trip")]]);
        //            return sendError(__("messages.no_matched_track_start_point"), ["origin error" => [__("messages.no_matched_track_start_point")]]);
        //        }

        $data = collect();
        // check if there are track have the client desired destination
        $tracks = Track::whereIn("id", $startLocation->isNotEmpty() ? $startLocation->pluck("id")->toArray() : [])
            ->where(function ($q) use ($destination) {
                $q->whereBetween("destination->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("destination->lng", [$destination["minLng"], $destination["maxLng"]]);
                $q->orWhereHas("waypoints", function ($qu) use ($destination) {
                    $qu->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                });
            })
            ->get()
            ->filter(function ($track) use ($helper, $request) {
                $inWaypoint = false;
                if ($track->waypoints->isNotEmpty()) {
                    $inWaypoint = $track->waypoints->some(function ($waypoint) use ($helper, $request) {
                        $timeRange = $this->timeRange($helper->addTime($waypoint->track->origin["start_time"], $waypoint->waypoint["duration"]));
                        return $request->time >= $timeRange[0] && $request->time <= $timeRange[1];
                    });
                }
                $timeRangeOrigin = $this->timeRange($track->origin["start_time"]);
                $inOrigin = $request->time >= $timeRangeOrigin[0] && $request->time <= $timeRangeOrigin[1];

                if ($inWaypoint || $inOrigin) {
                    return $track;
                }
                return null;
            });

        //        if ($tracks->count() == 0) {
        //            if (!empty($neglictedTrackIds) && count($neglictedTrackIds) > 0)
        //                return sendError(__("messages.already_booked_trip"), ["already_booked" => [__("messages.already_booked_trip")]]);
        //            return sendError(__("messages.no_trips_found_at_this_time"), ["destination error" => [__("messages.no_trips_found_at_this_time")]]);
        //        }

        if ($tracks->isNotEmpty()) {
            $trackIds = $tracks->pluck("id")->toArray();
            // check that the car in the track has place on it
            $data = $tracks->filter(function ($track) use ($trackIds, &$arr, $origin, $destination, $tripDates) {
                $validCapacity = $track->vehicle->year->model->capacity;
                $arr = [];

                $clientTrack = [];
                if ($track->waypoints()->count()) {
                    $waypoints = $track->waypoints->pluck("waypoint");
                } else {
                    $waypoints = [];
                }
                $spreadTrack = collect([$track->origin, ...$waypoints, $track->destination]);

                $spreadTrack->filter(function ($q) use ($origin, $destination, &$clientTrack, $track) {
                    if (!isset($clientTrack["origin"]) && $origin["minLat"] < +$q["lat"] && +$q["lat"] < $origin["maxLat"] && $origin["minLng"] < +$q["lng"] && +$q["lng"] < $origin["maxLng"]) {
                        $clientTrack["origin"] = $q;
                    }

                    if ($destination["minLat"] < +$q["lat"] && +$q["lat"] < $destination["maxLat"] && $destination["minLng"] < +$q["lng"] && +$q["lng"] < $destination["maxLng"] && isset($clientTrack["origin"])) {
                        if ($clientTrack["origin"] != $q) {
                            $clientTrack["destination"] = $q;
                        }
                    }

                    if (isset($clientTrack["origin"]) && isset($clientTrack["destination"])) {
                        $clientTrack["distance"] = +$clientTrack["destination"]["distance"] - $clientTrack["origin"]["distance"];
                    }
                });

                foreach ($tripDates as $day) {
                    $consumedCapacity = Trip::whereIn("track_id", $trackIds)
                        ->where("date", $day)
                        ->whereNull('end_at')
                        ->count();

                    $valid = $validCapacity > $consumedCapacity;
                    array_push($arr, $valid);
                };

                if (empty($arr))
                    return null;

                if (!in_array(false, $arr)) {
                    $validCapacities = array_values($track->trips()->whereIn("date", $tripDates)->whereNull('end_at')->get()->groupBy("date")->map(function ($qu) {
                        return $qu->count();
                    })->toArray());
                    $track->occupaiedCapacity = $validCapacities ? max($validCapacities) : 0;
                    $track->validCapacity = $validCapacity - $track->occupaiedCapacity;
                    $track->totalPrice = $track->owner->other_price * $clientTrack["distance"];
                    $track->date = $tripDates[0];

                    return $track;
                }
                return null;
            });
        }

        if ($data->isNotEmpty()) {
            return sendResponse(SearchTripResource::collection($data));
        } else {
            $data = $this->searchTrackByDays($request, $helper);
            if ($data->isNotEmpty())
                return sendResponse(SearchTripResource::collection($data));
        }
        return sendError(__("no_tips_or_tracks"), ["capacity error" => [__("no_tips_or_tracks")]]);
    }

    private function searchTrackByDays($request, $helper)
    {
        $tripDates = $this->tripDates()->toArray();
        if (empty($tripDates)) {
            $message = __('messages.there_is_no_days_included_in_the_date_range');
            throw new HttpResponseException(sendError($message, ["can't search" => $message]));
        }

        $origin = $this->rad($request->origin["lat"], $request->origin["lng"]);
        $destination = $this->rad($request->destination["lat"], $request->destination["lng"]);

        # Not Started Trips to neglict double reservations
        $neglictedTrackIds = Trip::query()->whereClientId($request->user()->id)->whereNull('start_at')->whereDate('date', Carbon::parse($tripDates[0])->toDateString())->pluck('track_id')->toArray();
        // check if there are track have the client desired origin
        $startLocation = Track::query()
            ->where(function ($query) {
                $query->orWhereHas('driver', function ($query) {
                    $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                        ->where('is_active', true)->where('update_price', 0);
                })->orWhereHas('owner', function ($query) {
                    $query->whereDate('driver_license_end_date', '>', now()->toDateString())
                        ->where('is_active', true)->where('update_price', 0);
                });
            })
            ->whereNotIn('id', $neglictedTrackIds)
            ->whereIsActive(true)->whereJsonContains("repeat", $request->repeat)
            ->where(function ($q) use ($origin) {
                $q->whereBetween("origin->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("origin->lng", [$origin["minLng"], $origin["maxLng"]]);
                $q->orWhereHas("waypoints", function ($qu) use ($origin) {
                    $qu->whereBetween("waypoint->lat", [$origin["minLat"], $origin["maxLat"]])->whereBetween("waypoint->lng", [$origin["minLng"], $origin["maxLng"]]);
                });
            })->get();

        $data = collect();
        if ($startLocation->isNotEmpty()) {
            // check if there are track have the client desired destination
            $tracks = Track::whereIn("id", $startLocation->pluck("id")->toArray())
                ->where(function ($q) use ($destination) {
                    $q->whereBetween("destination->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("destination->lng", [$destination["minLng"], $destination["maxLng"]]);
                    $q->orWhereHas("waypoints", function ($qu) use ($destination) {
                        $qu->whereBetween("waypoint->lat", [$destination["minLat"], $destination["maxLat"]])->whereBetween("waypoint->lng", [$destination["minLng"], $destination["maxLng"]]);
                    });
                })
                ->get();
            if ($tracks->isNotEmpty()) {
                $trackIds = $tracks->pluck("id")->toArray();
                // check that the car in the track has place on it
                $data = $tracks->unique(function ($track) use ($trackIds, &$arr, $origin, $destination, $tripDates) {
                    $validCapacity = $track->vehicle->year->model->capacity;
                    $arr = [];

                    $clientTrack = [];
                    if ($track->waypoints()->count()) {
                        $waypoints = $track->waypoints->pluck("waypoint");
                    } else {
                        $waypoints = [];
                    }
                    $spreadTrack = collect([$track->origin, ...$waypoints, $track->destination]);

                    $spreadTrack->filter(function ($q) use ($origin, $destination, &$clientTrack, $track) {
                        if (!isset($clientTrack["origin"]) && $origin["minLat"] < +$q["lat"] && +$q["lat"] < $origin["maxLat"] && $origin["minLng"] < +$q["lng"] && +$q["lng"] < $origin["maxLng"]) {
                            $clientTrack["origin"] = $q;
                        }

                        if ($destination["minLat"] < +$q["lat"] && +$q["lat"] < $destination["maxLat"] && $destination["minLng"] < +$q["lng"] && +$q["lng"] < $destination["maxLng"] && isset($clientTrack["origin"])) {
                            if ($clientTrack["origin"] != $q) {
                                $clientTrack["destination"] = $q;
                            }
                        }

                        if (isset($clientTrack["origin"]) && isset($clientTrack["destination"])) {
                            $clientTrack["distance"] = +$clientTrack["destination"]["distance"] - $clientTrack["origin"]["distance"];
                        }
                    });

                    foreach ($tripDates as $day) {
                        $consumedCapacity = Trip::whereIn("track_id", $trackIds)
                            ->where("date", $day)
                            ->whereNull('end_at')
                            ->count();

                        $valid = $validCapacity > $consumedCapacity;
                        array_push($arr, $valid);
                    };

                    if (empty($arr))
                        return null;

                    if (!in_array(false, $arr)) {
                        $validCapacities = array_values($track->trips()->whereIn("date", $tripDates)->whereNull('end_at')->get()->groupBy("date")->map(function ($qu) {
                            return $qu->count();
                        })->toArray());
                        $track->occupaiedCapacity = $validCapacities ? max($validCapacities) : 0;
                        $track->validCapacity = $validCapacity - $track->occupaiedCapacity;
                        $track->totalPrice = $track->owner->other_price * $clientTrack["distance"];
                        $track->date = $tripDates[0];
                        return $track;
                    }
                    return null;
                });
            }
        }

        return $data;
    }
}
