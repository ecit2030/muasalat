<?php

namespace App\Support\Traits;

use App\Scopes\ActiveScope;
use Modules\UserActivity\App\Traits\Loggable;

trait WithBoot
{
    use Loggable;

    protected static function boot()
    {
        parent::boot();

        if (! activeGuard('dashboard') && ! activeGuard('merchant')) {
            static::addGlobalScope(new ActiveScope());
        }
    }
}
