<?php

namespace App\Support\Helper;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class MhelperClass
{
    public function subTime($firstTime, $secondTime)
    {
        $firstTime = explode(':', $firstTime);
        $secondTime = explode(':', $secondTime);
        return Carbon::createFromTime(((int)$firstTime[0]), ((int)$firstTime[1]), 0)->subHours((int)$secondTime[0])->subMinutes((int)$secondTime[1])->format("H:i");
    }
    public function addTime($firstTime, $secondTime)
    {
        $firstTime = explode(':', $firstTime);
        $secondTime = explode(':', $secondTime);
        return Carbon::createFromTime(((int)$firstTime[0]), ((int)$firstTime[1]), 0)
            ->addHours((int)$secondTime[0])->addMinutes((int)$secondTime[1])->format("H:i");
    }

    public function addMinutes($minutes,$firstTime)
    {
        $currentTime = Carbon::now()->format('H:i');
        $firstTime = $firstTime ? explode(':', $firstTime) : $currentTime;
        return Carbon::createFromTime(((int)$firstTime[0]), ((int)$firstTime[1]), 0)
            ->addMinutes((int)$minutes)->format("H:i");
    }

    function time($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $kilometers = $dist * 60 * 1.1515 * 1.609344;
        $time =  explode(".", $kilometers / 70);

        if (count($time) == 2) {
            $time = '' . $time[0] . ':' . substr($time[1] * 60, 0, 2);
        } else {
            $time = '' . $time[0] . ':00';
        }

        return $time;
    }
}
