<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DriversActions
{
    // public function nearestDrivers($tripStartLat, $tripStartLong,$trip = null): Collection|array
    // {
    //     return User::query()
    //         ->select(DB::raw('*, ( 6371 * acos( cos( radians(' . $tripStartLat . ') ) * cos( radians( `latitude` ) ) * cos(radians( `longitude` ) - radians(' . $tripStartLong . ') ) + sin( radians(' . $tripStartLat . ') ) * sin( radians( `latitude` ) ) ) ) as distance'))
    //         ->whereHas('roles', function ($query) {
    //             $query->where('name', 'captain');
    //         })
    //         ->whereHas('deviceTokens')
    //         ->where(function($q){
    //             $q->where('other_price','>',0)
    //             ->orWhereHas('driverOrg',function($q){
    //                 $q->where('other_price','>',0);
    //             });
    //         })
    //         ->whereNotNull('latitude')
    //         ->whereNotNull('longitude')
    //         // ->whereDoesntHave('driverTrips', function (Builder $builder) use($trip){
    //         //     $builder->where(function($q) use($trip){
    //         //         $q->where("date",$trip->date)
    //         //         // ->where('is_canceled', 0)
    //         //         ->whereHas('report', function ($q) {
    //         //             $q->where('is_paid', 1);
    //         //         });
    //         //     });
    //         // })
    //         ->where('is_active', 1)
    //         ->where('is_online', 1)
    //         ->having('distance', '<=', setting('general', 'searchRange', 5))
    //         ->orderBy('distance', 'ASC')
    //         ->get();
    // }
public function nearestDrivers($tripStartLat, $tripStartLong, $trip = null): Collection|array
{
    return User::query()
        ->with([
            'vehicle',
            'vehicleYear.model',
            'driverTrips.report',
            'driverOrg',
        ])
        ->select(DB::raw('
            *,
            (
                6371 * acos(
                    cos(radians(' . $tripStartLat . '))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians(' . $tripStartLong . '))
                    + sin(radians(' . $tripStartLat . '))
                    * sin(radians(latitude))
                )
            ) as distance
        '))
        ->whereHas('roles', function ($query) {
            $query->where('name', 'captain');
        })
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->where('is_online', 1)
        ->where('is_active', 1)
        ->get();
}
    public function allActiveDrivers(): Collection|array
    {
        return User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'captain');
            })
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->get();
    }

    // Old distance implementation kept here for quick rollback.
    // To return to it, comment the active calcDistance() below and uncomment this function.
    //
    // function calcDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km'): array
    // {
    //     $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?key=' . config('general.google_map_key') . '&origins=' . $lat1 . ',' . $lon1 . '&destinations=' . $lat2 . ',' . $lon2 . '&language=en-EN&sensor=false&units=' . $unit)->json();
    //     if ($response['status'] == "OK" && $response['rows'][0]['elements'][0]["status"] == "OK") {
    //         $data['distance'] = round($response['rows'][0]['elements'][0]['distance']['value'] / 1000, 2);
    //         $data['duration'] = round($response['rows'][0]['elements'][0]['duration']['value'] / 60, 2);
    //     } else {
    //         $data['distance'] = 1;
    //         $data['duration'] = 1;
    //     }
    //
    //     return $data;
    // }

    function calcDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km'): array
    {
        $fallbackDistance = $this->haversineDistance($lat1, $lon1, $lat2, $lon2);

        try {
            $response = Http::timeout(10)->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'key' => config('general.google_map_key'),
                'origins' => $lat1 . ',' . $lon1,
                'destinations' => $lat2 . ',' . $lon2,
                'language' => 'en-EN',
                'sensor' => 'false',
                'units' => $unit,
            ])->json();

            $element = data_get($response, 'rows.0.elements.0');
            if (data_get($response, 'status') === 'OK' && data_get($element, 'status') === 'OK') {
                return [
                    'distance' => round(data_get($element, 'distance.value', 0) / 1000, 2),
                    'duration' => round(data_get($element, 'duration.value', 0) / 60, 2),
                ];
            }
        } catch (\Throwable $exception) {
            report($exception);
        }

        return [
            'distance' => $fallbackDistance,
            'duration' => $this->estimateDuration($fallbackDistance),
        ];
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371;
        $latDelta = deg2rad((float) $lat2 - (float) $lat1);
        $lonDelta = deg2rad((float) $lon2 - (float) $lon1);

        $a = sin($latDelta / 2) ** 2
            + cos(deg2rad((float) $lat1)) * cos(deg2rad((float) $lat2))
            * sin($lonDelta / 2) ** 2;

        return round($earthRadius * (2 * atan2(sqrt($a), sqrt(1 - $a))), 2);
    }

    private function estimateDuration(float $distance): float
    {
        $averageUrbanSpeedKmPerHour = 40;

        return round(($distance / $averageUrbanSpeedKmPerHour) * 60, 2);
    }
}
