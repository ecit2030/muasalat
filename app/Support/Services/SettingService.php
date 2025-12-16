<?php

namespace App\Support\Services;

use App\Models\Setting;
use Arr;

class SettingService
{
    public static function save(string $key, $value)
    {
        Setting::updateOrcreate(
            ['key' => 'general'],
            ['value' => Arr::pull($value, $key)]
        );
    }
}
