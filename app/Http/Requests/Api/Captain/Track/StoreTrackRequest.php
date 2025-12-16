<?php

namespace App\Http\Requests\Api\Captain\Track;

use App\Support\Helper\MhelperClass;
use App\Support\Traits\ValidationRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator as Validation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreTrackRequest extends FormRequest
{
    use ValidationRequest;

    public function __construct(private MhelperClass $helper)
    {
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:100',

            'origin.location' => 'required|string|max:100',
            'origin.lat' => 'required|string|max:100',
            'origin.lng' => 'required|string|max:100',
            'origin.start_time' => 'required|date_format:H:i',

            'destination.location' => 'required|string|max:100',
            'destination.lat' => 'required|string|max:100',
            'destination.lng' => 'required|string|max:100',
            "destination.duration" => "required|date_format:H:i",
            "destination.distance" => "required|string|max:100",

            "waypoints" => "array|max:10",
            "waypoints.*.location" => "required|string|max:100",
            "waypoints.*.lat" => "required|string|max:100",
            "waypoints.*.lng" => "required|string|max:100",
            "waypoints.*.duration" => "required|date_format:H:i",
            "waypoints.*.distance" => "required|string|max:100",

            "map_route_data" => "required",
            "repeat" => "required|array",
            "repeat.*" => "required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday"
        ];
    }


    public function withValidator(Validator $validator)
    {

        if (count($validator->errors()) > 0) {
            throw new HttpResponseException(sendError(__('messages.error_valation'), $validator->errors()));
        }

        if (auth()->user()->vehicle()->count() == 0) {
            throw new HttpResponseException(sendError(__('messages.please_add_car_details'), ["sasd" => __('messages.please_add_car_details')]));
        }

        $user = auth()->user()->load('vehicle');

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

        $validator->after(function ($validator) {

            if (is_null(auth()->user()->talebat_price) || is_null(auth()->user()->other_price)) {
                throw new HttpResponseException(sendError(__("Please Add Prices First"), ["missing_price" => __("Please Add Prices First")]));
            }

            $tracks = auth()
                ->user()
                ->tracks()
                ->whereIsActive(true)
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
                        }

                        $NewTrackFinishTime = $this->helper->addTime($this->destination["duration"], $this->origin["start_time"]);

                        foreach ($shortArray as $day) {
                            $exist = is_numeric(array_search($day, $longArray));
                            if ($exist) {

                                $oldTrackFinishTime = $this->helper->addTime($oldTrack->destination["duration"], $oldTrack->origin["start_time"]);
                                $timeBetweenNewStartAndOldFinish = $this->helper->time($oldTrack->destination["lat"], $oldTrack->destination["lng"], $this->origin["lat"], $this->origin["lng"]);
                                $timeBetweenNewFinishAndOldStart = $this->helper->time($oldTrack->origin["lat"], $oldTrack->origin["lng"], $this->destination["lat"], $this->destination["lng"]);
                                $newOldTrackFinishTime = $this->helper->addTime($timeBetweenNewStartAndOldFinish, $oldTrackFinishTime);

                                if ($this->origin["start_time"] > $oldTrack->origin["start_time"]) {

                                    $check = $this->origin["start_time"] < $newOldTrackFinishTime;

                                    if ($check) {
                                        throw new HttpResponseException(
                                            sendError(
                                                __("driver or car wil be in this time range , track name is ( :name ) you should start the new track after :time", ['name' => $oldTrack->name, 'time' => $newOldTrackFinishTime])
                                            )
                                        );
                                        break;
                                    }
                                } elseif ($this->origin["start_time"] < $oldTrack->origin["start_time"]) {

                                    $sNewTrackFinishTime = $this->helper->addTime($NewTrackFinishTime, $timeBetweenNewFinishAndOldStart);
                                    $newTrackTotalTime = $this->helper->addTime($this->destination["duration"], $timeBetweenNewFinishAndOldStart);

                                    $timeShouldStartIn = $this->helper->subTime($oldTrack->origin["start_time"], $newTrackTotalTime);
                                    $check = $sNewTrackFinishTime > $oldTrack->origin["start_time"];
                                    if ($check) {
                                        throw new HttpResponseException(
                                            sendError(
                                                __("driver or car wil be in this time range , track name is ( :name ) you should start the new track before :time", ['name' => $oldTrack->name, 'time' => $timeShouldStartIn])
                                            )
                                        );
                                        break;
                                    }
                                } elseif ($this->origin["start_time"] == $oldTrack->origin["start_time"]) {
                                    throw new HttpResponseException(sendError(__("driver or car wil be in this time range , track name is ( :name )", ['name' => $oldTrack->name])));
                                    break;
                                }
                            }
                        }
                    }
                );
            }
        });
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(sendError(__('messages.error_validation'), $validator->errors()));
    }
}
