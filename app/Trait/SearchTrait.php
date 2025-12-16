<?php

namespace App\Trait;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

trait SearchTrait
{
    public function rad($lat, $lng, $tolerantFactor = 1)
    {
        $general = setting('general');
        $searchRange = (int)data_get($general, "searchRange", 1) + $tolerantFactor;
        $range = $searchRange * 0.009;

        $minLat = $lat - $range;
        $maxLat = $lat + $range;
        $minLng = $lng - ($range / cos($lat * pi() / 180));
        $maxLng = $lng + ($range / cos($lat * pi() / 180));
        return [
            "minLat" => round($minLat, 4),
            "maxLat" => round($maxLat, 4),
            "minLng" => round($minLng, 4),
            "maxLng" => round($maxLng, 4)
        ];
    }

    public function timeRange($time)
    {
        $time = explode(':', $time);
        $time = Carbon::createFromTime((int)$time[0], (int)$time[1], 0);
        $addTime = clone $time;
        $subTime = clone $time;
        $general = setting('general');
        $timeRange = (int)data_get($general, "timeRange", 30);
        $startLimit = $subTime->subMinutes($timeRange);
        if ($startLimit->format('H:i') <= '00:30')
            $startLimit->startOfDay();
        $endlimit = $addTime->addMinutes($timeRange);
        if ($endlimit->format('H:i') >= '23:30')
            $endlimit->setTime(23, 59, 59);
        $times = [
            $startLimit->format("H:i"), $endlimit->format("H:i")
        ];
        return $times;
    }

    public function tripDates()
    {
        return collect(CarbonPeriod::since(request("start_date"))->days(1)->until(request("end_date")))->filter(function ($date) {
            foreach (request("repeat") as $value) {
                if (is_array($value)) {
                    if (array_key_exists('day', $value)) {
                        if ($date->is($value['day'])) {
                            return $date;
                        }
                    }
                } else {
                    if ($date->is($value)) {
                        return $date;
                    }
                }
            }
        })->map(function ($date) {
            return ['date' => $date->format('Y-m-d')];
        })->pluck("date");
    }

    public function tripDatesArray($simpleArray = false)
    {
        $daysOfWeek = [
            'Sunday' => [],
            'Monday' => [],
            'Tuesday' => [],
            'Wednesday' => [],
            'Thursday' => [],
            'Friday' => [],
            'Saturday' => [],
        ];

        $filteredDates = collect(CarbonPeriod::since(request("start_date"))->days(1)->until(request("end_date")))->filter(function ($date) {
            foreach (collect(request("repeat"))->pluck("day") as $value) {
                if ($date->is($value)) {
                    return true;
                }
            }
        })->values();

        $filteredDates->each(function ($date) use (&$daysOfWeek) {
            $carbonDate = Carbon::parse($date);
            $dayOfWeek = $carbonDate->format('l');
            $daysOfWeek[$dayOfWeek][] = $date->format('Y-m-d');
        });

        $daysOfWeek = array_filter($daysOfWeek, function ($dates) {
            return !empty($dates);
        });

        if ($simpleArray) {
            $dates = [];
            collect($daysOfWeek)->each(function ($day) use (&$dates) {
                $dates = [...$dates, ...$day];
            });
            return $dates;
        }

        return $daysOfWeek;
    }


    public function filterSchedulesByDay($schedules, $desiredDay)
    {
        $data = array_filter($schedules, function ($schedule) use ($desiredDay) {
            return $schedule["day"] === $desiredDay;
        });
        return collect($data)->first();
    }
}
