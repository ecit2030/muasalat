<?php

namespace App\Http\Controllers\Api\Driver;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Captain\Trip\StartAndEndTripRequest;
use App\Http\Resources\Api\Captain\Trip\TrackTripResource;
use App\Http\Resources\Api\Driver\Trip\TripButItsTrackResource;
use App\Http\Resources\Api\Driver\Trip\TripResource;
use App\Models\Track;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripController extends ApiController
{
    function index(Request $request, Carbon $carbon)
    {
        $filter = isset($request->filter) ? $request->filter : "current";

        // for ($i = 0; $i < 7; $i++) {
        //     $date = $carbon->today()->addDays($i)->format('Y-m-d');
        //     $day = $carbon->createFromFormat('Y-m-d', $date)->format('l');
        //     $days[$date] = $day;
        // }

        $tomorrow = now()->addDay()->toDateString();
        $toDate = now()->addWeek()->toDateString();
        if ($filter == 'upcoming') {

            $currentTime = now()->format('H:i');
            $data = Track::query()
                ->whereIsActive(1)
                ->whereDriverId(auth()->id())
                ->with('waypoints')
                ->withWherehas('trips', function ($query) use ($currentTime, $tomorrow, $toDate) {
                    $query->where(function ($query) {
                        $query->whereNull("start_at")
                            ->whereNull("end_at");
                    })->where(function ($query) use ($currentTime, $tomorrow, $toDate) {
                        $query->orWhere(function ($query) use ($currentTime) {
                            $query->whereDate("date", now()->toDateString())
                                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) > ?", [$currentTime]);
                        })->orWhere(function ($query) use ($tomorrow, $toDate) {
                            $query->whereBetween('date', [$tomorrow, $toDate]);
                        });
                    })->with(["report", "client"]);
                })
                ->get();

            return sendResponse(TrackTripResource::collection($data));
            // $data = auth()->user()->driverTracks()->whereIsActive(true)
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
                ->whereIsActive(1)
                ->whereDriverId(auth()->id())
                ->with('waypoints')
                ->whereHas('trips', function ($query) use ($filter) {
                    $query->when($filter == 'previous', function ($q) {
                        return $q->whereNotNull("start_at")->whereNotNull("end_at");
                    })->when($filter == 'current', function ($q) {
                        return $q->whereNotNull("start_at")->whereNull("end_at");
                    });
                })
                ->with(['trips' => function ($query) use ($filter) {
                    $query->when($filter == 'previous', function ($q) {
                        return $q->whereNotNull("start_at")->whereNotNull("end_at");
                    })->when($filter == 'current', function ($q) {
                        return $q->whereNotNull("start_at")->whereNull("end_at");
                    });
                }])->get();
            return sendResponse(TrackTripResource::collection($data));
            // $data = auth()
            //     ->user()
            //     ->driverTrips()
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
            return sendError("messages.cant_start_trip");
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

        // driver
        $trips = $exists->get();
        $tokens = auth()->user()->sendableTokens;
        auth()->user()->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.hi_driver") . " " . t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_started"), FCMTopic::DRIVER_TRIP_STARTED, FCMAction::DRIVER_OPEN_CURRENT_TRIPS, $track->id));

        // org
        $tokens = auth()->user()->driverOrg->sendableTokens;
        auth()->user()->driverOrg->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_started"), FCMTopic::ADMIN_TRIP_STARTED, FCMAction::NO_ACTION, $track->id));

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
        $track = Track::find($request->track_id);

        if ($track->trips()->where("date", Carbon::today()->format("Y-m-d"))->withTrashed()->first()?->end_at != null) {
            return sendError("messages.cant_finish_trip");
        } else {
            $track->touch();
            $trips = Trip::where("track_id", $track->id)->where("date", $request->date)->whereNotNull("start_at")->whereNull("end_at")->withTrashed();


            // driver
            $tokens = auth()->user()->sendableTokens;
            auth()->user()->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.hi_driver") . " " . t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_finished"), FCMTopic::DRIVER_TRIP_FINISHED, FCMAction::DRIVER_OPEN_PREVIOUS_TRIPS, $track->id));

            // org
            $tokens = auth()->user()->driverOrg->sendableTokens;
            auth()->user()->driverOrg->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_finished"), FCMTopic::ADMIN_TRIP_FINISHED, FCMAction::NO_ACTION, $track->id));

            // admins
            $admins = User::role("admin")->get();
            foreach ($admins as $admin) {
                $tokens = $admin->sendableTokens;
                $admin->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("track") . " " . $track?->name . " " . t_("messages.have_been_finished"), FCMTopic::ADMIN_TRIP_FINISHED, FCMAction::NO_ACTION));
            }

            // users
            foreach ($trips->get()->unique("client_id") as $trip) {
                $tokens = $trip->client->sendableTokens;
                $trip->client->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.hi_client") . " " . t_("messages.your_trip") . " " . $track?->name . " " . t_("messages.have_been_finished"), FCMTopic::CLIENT_TRIP_FINISHED, FCMAction::CLIENT_OPEN_PREVIOUS_TRIPS, $trip->id));
            }

            $trips->update([
                "end_at" => Carbon::now()
            ]);
        }

        return sendResponse(new TripButItsTrackResource($track));
    }
}
