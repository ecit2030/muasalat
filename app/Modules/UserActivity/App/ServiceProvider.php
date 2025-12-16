<?php

namespace Modules\UserActivity\App;

use Modules\UserActivity\App\Console\UserActivityDelete;
use Modules\UserActivity\App\Console\UserActivityInstall;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public const CONFIG_PATH = __DIR__.'/../config/user-activity.php';

    public const ROUTE_PATH = __DIR__.'/../routes';

    public const VIEW_PATH = __DIR__.'/../views';

    public const ASSET_PATH = __DIR__.'/../assets';

    public const MIGRATION_PATH = __DIR__.'/../migrations';

    public function boot()
    {
        $this->publish();

        $this->loadRoutesFrom(self::ROUTE_PATH.'/web.php');
        $this->loadViewsFrom(self::VIEW_PATH, 'UserActivity');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'user-activity'
        );

        $this->app->register(EventServiceProvider::class);
        $this->commands([UserActivityInstall::class, UserActivityDelete::class]);
    }

    private function publish()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('user-activity.php'),
        ], 'config');

        $this->publishes([
            self::MIGRATION_PATH => database_path('migrations'),
        ], 'migrations');
    }
}
