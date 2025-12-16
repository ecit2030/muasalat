<?php

namespace Modules\UserActivity\App;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\UserActivity\App\Listeners\LockoutListener;
use Modules\UserActivity\App\Listeners\LoginListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LoginListener::class,
        ],
        Lockout::class => [
            LockoutListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
