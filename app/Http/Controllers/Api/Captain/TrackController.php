<?php

namespace App\Http\Controllers\Api\Captain;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Captain\Track\StoreTrackRequest;
use App\Http\Resources\Api\Captain\Track\TrackResource;
use App\Models\Track;
use App\Support\Helper\MhelperClass;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class TrackController extends ApiController
{
    function index(Request $request)
    {
        $tracksByDateThenActivation = auth()->user()->tracks->sortByDesc(function ($track) {
            return $track->created_at?->timestamp ?? 0;
        })->sortBy([
            ['is_active', 'desc'],
        ]);
        return sendResponse(TrackResource::collection($tracksByDateThenActivation));
    }

    function show(Track $track)
    {
        if ($track->owner_id != auth()->id()) {
            return sendError(t_("you dont have permisssion to access this track"));
        }

        return sendResponse(new TrackResource($track));
    }

    function store(StoreTrackRequest $request)
    {
        $req = $request->validated();

        $req["origin"]["duration"] = "00:00";
        $req["origin"]["distance"] = "0";
        $req["owner_id"] = auth()->id();
        $req["driver_id"] = auth()->id();
        $req["user_vehicle_id"] = auth()->user()->vehicle->id;

        $track = Track::create($req);

        foreach ($req["waypoints"] as $value) {
            $track->waypoints()->create([
                "waypoint" => $value
            ]);
        }

        return sendResponse(new TrackResource($track), __("messages.resource_created"));
    }


    function destroy(Track $track)
    {
        $check = $track->trips()->count();

        if ($check == 0) {
            $track->delete();
            return sendResponse(__("messages.resource_deleted"));
        };

        return sendError(t_('cant deleted this record ') . " " . t_("users has purchased this track"));
    }

    function activation(Track $track)
    {
        $user = auth()->user()->load('vehicle');

        if ($user->update_price)
            return sendError(__("Update price first"));

        if (!is_null($user->vehicle)) {
            if (Carbon::now() > $user->vehicle->license_end_date) {
                throw new HttpResponseException(sendError(__("messages.the_license_of_the_car_is_expired"), ["sasd" => __("messages.the_license_of_the_car_is_expired")]));
            }

            if (Carbon::now() > $user->vehicle->ensurance_end_date) {
                throw new HttpResponseException(sendError(__("messages.the_ensurance_0of_the_car_is_expired"), ["sasd" => __("messages.the_ensurance_0of_the_car_is_expired")]));
            }

            if (Carbon::now() > $user->vehicle->periodic_end_date) {
                throw new HttpResponseException(sendError(__("messages.the_periodic_of_the_car_is_expired"), ["sasd" => __("messages.the_periodic_of_the_car_is_expired")]));
            }
        }

        if (Carbon::now() > $user->driver_license_end_date) {
            throw new HttpResponseException(sendError(__("messages.the_driver_lisence_is_expired"), ["sasd" => __("messages.the_driver_lisence_is_expired")]));
        }

        $helper = new MhelperClass();
        if (!$track->is_active) {
            $tracks = auth()
                ->user()
                ->tracks()
                ->whereIsActive(true)
                ->get();

            $trackFinishTime = $helper->addTime($track->destination["duration"], $track->origin["start_time"]);

            foreach ($tracks as $activeTrack) {
                if (sizeof($activeTrack->repeat) > sizeof($track->repeat)) {
                    $longArray = $activeTrack->repeat;
                    $shortArray = $track->repeat;
                } else {
                    $longArray = $track->repeat;
                    $shortArray = $activeTrack->repeat;
                }

                foreach ($shortArray as $day) {
                    $exist = is_numeric(array_search($day, $longArray));
                    if ($exist) {

                        $activeTrackFinishTime = $helper->addTime($activeTrack->destination["duration"], $activeTrack->origin["start_time"]);
                        $timeBetweenNewStartAndOldFinish = $helper->time($activeTrack->destination["lat"], $activeTrack->destination["lng"], $track->origin["lat"], $track->origin["lng"]);
                        $timeBetweenNewFinishAndOldStart = $helper->time($activeTrack->origin["lat"], $activeTrack->origin["lng"], $track->destination["lat"], $track->destination["lng"]);
                        $newOldTrackFinishTime = $helper->addTime($timeBetweenNewStartAndOldFinish, $activeTrackFinishTime);

                        if ($track->origin["start_time"] > $activeTrack->origin["start_time"]) {

                            $check = $track->origin["start_time"] < $newOldTrackFinishTime;

                            if ($check) {
                                throw new HttpResponseException(
                                    sendError(
                                        __("driver or car wil be in this time range , track name is ( :name ) you should start the new track after :time", ['name' => $activeTrack->name, 'time' => $newOldTrackFinishTime])
                                    )
                                );
                            }
                        } elseif ($track->origin["start_time"] < $activeTrack->origin["start_time"]) {

                            $sNewTrackFinishTime = $helper->addTime($trackFinishTime, $timeBetweenNewFinishAndOldStart);
                            $newTrackTotalTime = $helper->addTime($track->destination["duration"], $timeBetweenNewFinishAndOldStart);

                            $timeShouldStartIn = $helper->subTime($activeTrack->origin["start_time"], $newTrackTotalTime);
                            $check = $sNewTrackFinishTime > $activeTrack->origin["start_time"];
                            if ($check) {
                                throw new HttpResponseException(
                                    sendError(
                                        __("driver or car wil be in this time range , track name is ( :name ) you should start the new track before :time", ['name' => $activeTrack->name, 'time' => $timeShouldStartIn])
                                    )
                                );
                            }
                        } elseif ($track->origin["start_time"] == $activeTrack->origin["start_time"]) {
                            throw new HttpResponseException(sendError(__("driver or car wil be in this time range , track name is ( :name )", ['name' => $activeTrack->name])));
                            break;
                        }
                    }
                }
            }
            tap($track)->update([
                'is_active' => !$track->is_active,
            ])->fresh();
        } else {
            $check = $track->trips()->whereNull("end_at")->count();
            if ($check == 0) {
                tap($track)->update([
                    'is_active' => !$track->is_active,
                ])->fresh();
            } else {
                return sendError(__("Failed to change Track status active trips found"), ["has_trips" => __("Failed to change Track status active trips found")]);
            }
        }

        if ($track->is_active)
            $message = __("Track Activated Successfully");
        else
            $message = __("Track Deactivated Successfully");
        return sendResponse($message);
    }
}
