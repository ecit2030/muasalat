<?php

namespace App\Trait;

use Http;

trait DistanceDurationTrait
{
    public function calcDistanceDuration($lat1, $lon1, $lat2, $lon2, $unit = 'km')
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?key=' . env('GOOGLE_MAP_API') . '&origins=' . $lat1 . ',' . $lon1 . '&destinations=' . $lat2 . ',' . $lon2 . '&language=en-EN&sensor=false&units=' . $unit)->json();
        if ($response['status'] == trans("ok") && $response['rows'][0]['elements'][0]["status"] == trans("ok")) {
            $data['distance'] = round($response['rows'][0]['elements'][0]['distance']['value'] / 1000, 2);
            $data['duration'] = round($response['rows'][0]['elements'][0]['duration']['value'] / 60, 2);
        } else {
            $data['distance'] = 1;
            $data['duration'] = 1;
        }
        return $data['distance'];
    }
}
