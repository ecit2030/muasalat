<?php

namespace App\Traits;

use App\Scopes\VisiableScope;

trait Visiable
{
    public static function booted()
    {
        static::addGlobalScope(new VisiableScope());
    }
}
