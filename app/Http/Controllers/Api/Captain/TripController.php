<?php

namespace App\Http\Controllers\Api\Captain;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Captain\Trip\StartAndEndTripRequest;
use App\Http\Resources\Api\Captain\Trip\TrackTripResource;
use App\Http\Resources\Api\Captain\Trip\TripButItsTrackResource;
use App\Http\Resources\Api\Captain\Trip\TripResource;
use App\Models\Track;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends ApiController
{
    function index(Request $request, Carbon $carbon)
    {
        // for ($i = 0; $i < 7; $i++) {
        //     $date = $carbon->today()->addDays($i)->format('Y-m-d');
        //     $day = $carbon->createFromFormat('Y-m-d', $date)->format('l');
        //     $days[$date] = $day;
        // }

        $tomorrow = now()->addDay()->toDateString();
        $toDate = now()->addWeek()->toDateString();
        $currentTime = now()->format('H:i');
        $filter = isset($request->filter) ? $request->filter : "current";

        if ($filter == 'upcoming') {
            $data = Track::query()
                ->whereIsActive(1)
                ->whereOwnerId(auth()->id())
                ->with('waypoints')
                ->withWherehas('trips', function ($query) use ($currentTime, $tomorrow, $toDate) {
                    $query->where(function ($query) {
                        $query->whereNull("start_at")
                            ->whereNull("end_at");
                    })->where(function ($query) use ($currentTime, $tomorrow, $toDate) {
                        $query->orWhere(function ($query) use ($currentTime) {
                            $query->whereDate("date", now()->toDateString())
                                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) > ? AND date=?", [$currentTime, now()->toDateString()]);
                        })->orWhere(function ($query) use ($tomorrow, $toDate) {
                            $query->whereBetween('date', [$tomorrow, $toDate]);
                        });
                    })->with(["report", "client"])->orderByDesc('date');
                })
                ->get();

            return sendResponse(TrackTripResource::collection($data));
            // $data = auth()->user()->captainTracks()->whereIsActive(true)
            //     ->where(function ($q) use ($filter) {
            //         $q->when($filter == 'upcoming', function ($q) {
            //             return $q;
            //         });
            //     })->when($filter == 'upcoming', function ($q) {
            //         return $q->orderBy("origin->start_time", "ASC");
            //     })->get();


            // $orderedData = [];
            // foreach ($days as $date => $day) {
            //     $data->map(function ($q) use ($day, &$orderedData, $date) {
            //         $dayNotExist = array_search($day, $q->repeat) === false;
            //         if (!$dayNotExist) {
            //             $obj = clone $q;
            //             $obj["date"] = $date;
            //             array_push($orderedData, $obj);
            //         }
            //     });
            // };

            // $data->map(function ($q) use (&$orderedData) {

            //     $oldTrips = $q->trips()->where("date", "<", Carbon::today()->format('Y-m-d'))->where(function ($q) {
            //         return $q->whereNull("start_at");
            //     })->groupBy("track_id")->groupBy("date")->get("date");

            //     foreach ($oldTrips as $trip) {
            //         $obj = clone $q;
            //         if ($trip->date) {
            //             $obj["date"] = $trip->date;
            //         } else {
            //             $obj["date"] = $trip;
            //         }
            //         array_push($orderedData, $obj);
            //     };
            // });
            // $data = collect($orderedData)->sortBy("date");

            // $data = $data->filter(function ($q) {
            //     $date = $q->date;
            //     if($date == now()->toDateString())
            //         $q = $q->where('origin->start_time','>=',now()->format('H:i'));

            //     $q1 = clone $q;
            //     $q2 = clone $q;

            //     $q1 = $q1->withCount(['trips' => function($query)use($date){
            //         $query->where("date",  $date)->whereNull("start_at")->whereNull("end_at");
            //     }])->first();
            //     $q2 = $q2->withCount(['trips' => function($query)use($date){
            //         $query->where("date",  $date)->withTrashed();
            //     }])->first();
            //     if($q1?->trips_count != 0 || $q2?->trips_count != 0)
            //     {
            //         return $q;
            //     }
            // });
            // return sendResponse(TripButItsTrackResource::collection($data));
        } else {
            $data = Track::query()
                ->when($filter == 'current', function ($q) {
                    $q->whereIsActive(1);
                })
                ->whereOwnerId(auth()->id())
                ->with('waypoints')
                ->withWherehas('trips', function ($query) use ($filter, $currentTime) {
                    $query->with(["report", "client"])
                        ->when($filter == 'previous', function ($q) {
                            return $q->whereNotNull("start_at")->whereNotNull("end_at");
                        })->when($filter == 'current', function ($q) use ($currentTime) {
                            return $q->whereDate("date", now()->toDateString())
                                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) <= ? AND date=?", [$currentTime, now()->toDateString()])
                                ->whereNull("end_at");
                        })->orderByDesc('date');
                })
                ->get();
            return sendResponse(TrackTripResource::collection($data));
            // $data = auth()
            //     ->user()
            //     //                ->whereRelation('captainTracks','is_active','==',1)
            //     ->captainTrips()
            //     ->with('report')
            //     ->withTrashed()
            //     ->select('trips.id', "track_id", 'date', 'rate', "start_at", "end_at")
            //     ->orderBy("date")
            //     ->groupBy("date")
            //     ->groupBy("track_id")
            //     ->when($filter == 'previous', function ($q) {
            //         return $q->whereNotNull("start_at")->whereNotNull("end_at");
            //     })->when($filter == 'current', function ($q) {
            //         return $q->whereNotNull("start_at")->whereNull("end_at");
            //     })->get();

            // return sendResponse(TripResource::collection($data));
        }
    }

    function testIndex()
    {
        $currentTime = now()->format('H:i');
        $data = Track::query()
            ->whereIsActive(1)
            ->whereOwnerId(auth()->id())
            ->with('waypoints')
            ->whereHas('trips', function ($query) use ($currentTime) {
                $query->whereDate("date", now()->toDateString())
                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) > ?", [$currentTime])
                    ->with(["report", "client"]);
            })
            ->with(["trips" => function ($query) use ($currentTime) {
                $query->whereDate("date", now()->toDateString())
                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) > ?", [$currentTime])
                    ->with(["report", "client"]);
            }])
            ->get();

        return sendResponse(TrackTripResource::collection($data));
    }

    function show(Trip $Trip)
    {
        return sendResponse(new TripResource($Trip));
    }


    function startTrip(StartAndEndTripRequest $request)
    {
        $exists = Trip::where("track_id", $request->track_id)->where("date", $request->date);
        $track = Track::find($request->track_id);
        if ($exists->count()) {
            $exists->update([
                "start_at" => Carbon::now()
            ]);
        } elseif ($track->trips()->where("date", Carbon::today()->format("Y-m-d"))->withTrashed()->first()?->start_at != null) {
            return sendError(__("messages.cant_start_trip"));
        } else {
            $trip = $track->trips()->forceCreate([
                "client_id" => auth()->id(),
                'date' => Carbon::today()->format('Y-m-d'),
                'rate' => 0,
                "origin" => $track->origin,
                "destination" => $track->destination,
                "start_at" => Carbon::now(),
                "deleted_at" => Carbon::now(),
            ]);
        }

        $trips = $exists->get();
        $user = $request->user()->load(['deviceTokens']);
        // captain
        $tokens = $user->sendableTokens;
        $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.hi_driver") . " " . t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_started"), FCMTopic::DRIVER_TRIP_STARTED, FCMAction::DRIVER_OPEN_CURRENT_TRIPS, $track->id));

        // admins
        $admins = User::role("admin")->get();
        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("track") . " " . $track?->name . " " . t_("messages.have_been_started"), FCMTopic::ADMIN_TRIP_STARTED, FCMAction::NO_ACTION));
        }

        // users
        foreach ($trips->unique("client_id") as $trip) {
            $tokens = $trip->client->sendableTokens;
            $trip->client->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.hi_client") . " " . t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_started"), FCMTopic::CLIENT_TRIP_STARTED, FCMAction::CLIENT_OPEN_CURRENT_TRIPS, $trip->id));
        }

        return sendResponse(new TripButItsTrackResource($track));
    }

    function finishTrip(StartAndEndTripRequest $request)
    {
        $track = Track::findOrFail($request->track_id);
        $track = Track::whereId($request->track_id)->withWherehas('trips', function ($query) use ($request) {
            $query->with('client.deviceTokens')
                ->whereDate("date", Carbon::parse($request->date)->toDateString())
                ->whereNotNull('start_at')
                ->whereNull('end_at');
        })->first();
        if ($track->trips?->isEmpty()) {
            return sendError(__("messages.cant_finish_trip"));
        } else {

            $trips = $track->trips->filter(function ($trip) {
                $startTime = $trip->origin['start_time'];
                $duration = $trip->destination['duration'];
                $splitDuration = explode(':', $duration);
                $endAt = Carbon::parse($trip->date . ' ' . $startTime)->addHours($splitDuration[0])->addMinutes($splitDuration[1]);

                if (now()->lte($endAt->subMinutes(10)) || now()->gte($endAt))
                    return $trip;
                else
                    return null;
            });

            if ($trips->isNotEmpty()) {
                $track->touch();

                $user = $request->user()->load(['deviceTokens']);
                // captain
                $tokens = $user->sendableTokens;
                $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.hi_driver") . " " . t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_finished"), FCMTopic::DRIVER_TRIP_FINISHED, FCMAction::DRIVER_OPEN_PREVIOUS_TRIPS, $track->id));

                // admins
                $admins = User::role("admin")->get();
                foreach ($admins as $admin) {
                    $tokens = $admin->sendableTokens;
                    $admin->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("track") . " " . $track?->name . " " . t_("messages.have_been_finished"), FCMTopic::ADMIN_TRIP_FINISHED, FCMAction::NO_ACTION));
                }

                // users
                foreach ($trips->unique("client_id") as $trip) {
                    $tokens = $trip->client?->sendableTokens;
                    $trip->client?->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.hi_client") . " " . t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_finished"), FCMTopic::CLIENT_TRIP_FINISHED, FCMAction::CLIENT_OPEN_PREVIOUS_TRIPS, $trip->id));
                }

                Trip::whereIn('id', $trips->pluck('id')->toArray())->update([
                    "end_at" => Carbon::now()
                ]);
            } else {
                return sendError(__("messages.you_can_finish_trip_at"));
            }
        }

        return sendResponse(new TripButItsTrackResource($track));
    }

    function destroy(Trip $Trip)
    {
        $Trip->delete();
        return sendResponse(__("messages.resource_deleted"));
    }
}
