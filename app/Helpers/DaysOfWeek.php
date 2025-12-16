<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class DaysOfWeek
{
    public readonly array $days;

    public Collection $daysOfWeek;

    public function __construct(array $indexes)
    {
        $this->daysOfWeek = collect([
            0 => ['ar' =>  'حد', 'en' => 'Sunday'][app()->getLocale()],
            1 => ['ar' =>  'اثنين', 'en' => 'Monday'][app()->getLocale()],
            2 => ['ar' =>  'ثلاثاء', 'en' => 'Tuesday'][app()->getLocale()],
            3 => ['ar' =>  'اربعاء', 'en' => 'Wednesday'][app()->getLocale()],
            4 => ['ar' =>  'خميس', 'en' => 'Thursday'][app()->getLocale()],
            5 => ['ar' =>  'جمعة', 'en' => 'Friday'][app()->getLocale()],
            6 => ['ar' =>  'سبت', 'en' => 'Saturday'][app()->getLocale()],
        ]);

        $this->days =  $this->daysOfWeek->filter(function ($value, $key) use ($indexes) {
            return in_array($key, $indexes);
        })->toArray();
    }

    public static function from(array $indexes)
    {
        return new self($indexes);
    }

    public static function all()
    {
        return (new self([0, 1, 2, 3, 4, 5, 6]))->daysOfWeek;
    }
}
