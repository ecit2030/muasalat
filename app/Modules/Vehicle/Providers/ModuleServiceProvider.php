<?php

namespace App\Modules\Vehicle\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    protected const CONFIG_PATH = __DIR__.'/../config/vehicle.php';

    protected const ROUTE_PATH = __DIR__.'/../routes';

    protected const VIEW_PATH = __DIR__.'/../views';

    protected const ASSET_PATH = __DIR__.'/../assets';
    protected const LANG_PATH = __DIR__.'/../assets/lang';

    protected const MIGRATION_PATH = __DIR__.'/../migrations';

    public function boot()
    {
        $ModuleName = basename(dirname(__DIR__, 1)); // Get module name

        $this->publish();
        $this->loadMigrationsFrom(self::MIGRATION_PATH);

        $this->loadTranslationsFrom(self::LANG_PATH, $ModuleName);
        $this->loadRoutesFrom(self::ROUTE_PATH.'/web.php');
        $this->loadViewsFrom(self::VIEW_PATH, 'UserActivity');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'user-activity'
        );
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
