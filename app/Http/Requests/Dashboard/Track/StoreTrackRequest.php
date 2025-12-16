<?php

namespace App\Http\Requests\Dashboard\Track;

use App\Models\User;
use App\Support\Helper\MhelperClass;
use App\Support\Traits\ValidationRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Modules\Vehicle\Models\UserVehicle;
use App\Trait\DistanceDurationTrait;

class StoreTrackRequest extends FormRequest
{
    use ValidationRequest, DistanceDurationTrait;

    public function __construct(private MhelperClass $helper)
    {
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:100',

            'start_location' => 'required|string|max:200|different:end_location',
            'start_latitude' => 'required|string|max:100|different:end_latitude',
            'start_longitude' => 'required|string|max:100|different:end_longitude',

            'end_location' => 'required|string|max:200|different:start_location',
            'end_latitude' => 'required|string|max:100|different:start_latitude',
            'end_longitude' => 'required|string|max:100|different:start_longitude',
            'end_distance' => 'required|string|max:100',
            'end_duration' => 'required|string|max:100',

            "checkPoint_location" => "array|max:10",
            "checkPoint_location.*" => "required|string|max:200",

            "checkPoint_duration" => "array|max:10",
            "checkPoint_duration.*" => "required|string|max:100",

            "checkPoint_distance" => "array|max:10",
            "checkPoint_distance.*" => "required|string|max:100",

            "checkPoint_latitude" => "array|max:10",
            "checkPoint_latitude.*" => "required|string|max:100",

            "checkPoint_longitude" => "array|max:10",
            "checkPoint_longitude.*" => "required|string|max:100",
            "map_route_data" => "required",
            "start_time" => "required|date_format:H:i",


            "total_distance" => "required|numeric",
            "total_duration" => "required|string|max:100",

            "user_vehicle_id" => "required|exists:user_vehicles,id",
            "driver_id" => "required|exists:users,id",

            "repeat" => "required|array|min:1|max:7",
            "repeat.*" => "required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday"

        ];
    }


    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $tracks = auth()
                ->user()
                ->tracks()
                ->whereIsActive(true)
                ->whereUserVehicleId($this->user_vehicle_id)
                ->orWhere("driver_id", $this->driver_id)
                ->get();

            if ($tracks && isset($this->repeat)) {
                $tracks->filter(
                    function ($oldTrack) {
                        if (sizeof($oldTrack->repeat) > sizeof($this->repeat)) {
                            $longArray = $oldTrack->repeat;
                            $shortArray = $this->repeat;
                        } else {
                            $longArray = $this->repeat;
                            $shortArray = $oldTrack->repeat;
                        };

                        $NewTrackFinishTime = $this->helper->addTime(gmdate("H:i", $this->end_duration), $this->start_time);

                        foreach ($shortArray as $day) {
                            $exist = is_numeric(array_search($day, $longArray));
                            if ($exist) {
                                if ($oldTrack->driver_id == $this->driver_id || $oldTrack->user_vehicle_id == $this->user_vehicle_id) {

                                    $oldTrackFinishTime = $this->helper->addTime($oldTrack->destination["duration"], $oldTrack->origin["start_time"]);
                                    $timeBetweenNewStartAndOldFinish = $this->helper->time($oldTrack->destination["lat"], $oldTrack->destination["lng"], $this->start_latitude, $this->start_longitude);
                                    $timeBetweenNewFinishAndOldStart = $this->helper->time($oldTrack->origin["lat"], $oldTrack->origin["lng"], $this->end_latitude, $this->end_longitude);
                                    $newOldTrackFinishTime = $this->helper->addTime($timeBetweenNewStartAndOldFinish, $oldTrackFinishTime);



                                    if ($this->start_time > $oldTrack->origin["start_time"]) {
                                        $check = $this->start_time <= $newOldTrackFinishTime;
                                        if ($check) {
                                            $this->validator->errors()->add(
                                                'time',
                                                t_("driver or car wil be in this time range . track name is ") . " ( " . $oldTrack->name . " ) " . t_("you should start the new track after") . " " . $newOldTrackFinishTime
                                            );
                                            break;
                                        }
                                    } elseif ($this->start_time < $oldTrack->origin["start_time"]) {

                                        $sNewTrackFinishTime = $this->helper->addTime($NewTrackFinishTime, $timeBetweenNewFinishAndOldStart);

                                        $newTrackTotalTime = $this->helper->addTime(gmdate("H:i", $this->total_duration), $timeBetweenNewFinishAndOldStart);
                                        $timeShouldStartIn = $this->helper->subTime($oldTrack->origin["start_time"], $newTrackTotalTime);
                                        $check = $sNewTrackFinishTime >= $oldTrack->origin["start_time"];

                                        if ($check) {
                                            $this->validator->errors()->add(
                                                'time',
                                                t_("driver or car wil be in this time range . track name is ") . " ( " . $oldTrack->name . " ) " . t_("you should start the new track before") . " " . $timeShouldStartIn
                                            );
                                            break;
                                        }
                                    } elseif ($this->start_time == $oldTrack->origin["start_time"]) {
                                        $this->validator->errors()->add(
                                            'time',
                                            t_("driver or car wil be in same time . track name is ") . " ( " . $oldTrack->name . " ) "
                                        );
                                        break;
                                    }
                                }
                            }
                        };
                    }
                );
            }

            $vehicle = UserVehicle::find($this->user_vehicle_id);

            if ($vehicle) {

                if (Carbon::now() > $vehicle->license_end_date) {
                    $this->validator->errors()->add(
                        'license expired',
                        __("messages.the_license_of_the_car_is_expired")
                    );
                }

                if (Carbon::now() > $vehicle->ensurance_end_date) {
                    $this->validator->errors()->add(
                        'ensurance expired',
                        __("messages.the_ensurance_0of_the_car_is_expired")
                    );
                }

                if (Carbon::now() > $vehicle->periodic_end_date) {
                    $this->validator->errors()->add(
                        'periodic expired',
                        __("messages.the_periodic_of_the_car_is_expired")
                    );
                }

            }

            $driver = User::find($this->driver_id);
            if($driver){
                if (Carbon::now() > $driver->driver_license_end_date) {
                    $this->validator->errors()->add(
                        'license expired',
                        __("messages.your_driver_lisence_is_expired")
                    );
                }
            }

            $distance = $this->calcDistanceDuration($this->start_latitude, $this->start_longitude, $this->end_latitude, $this->end_longitude);
            if ($distance > 10) {
                $this->validator->errors()->add(
                    'distance is very near',
                    t_("start address and end address can't be in same area")
                );
            }





            if ($validator->errors()) {
                return redirect()->back()->withErrors($validator);
            }

        });
    }


}
