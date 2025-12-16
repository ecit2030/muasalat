<?php

namespace App\Providers;

use App\Support\Sidebar\Sidebar;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Language\Models\Language;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->isProduction()) {
            if (env('TELESCOPE_PRODUCTION', false)) {
                $this->registerTelescope();
            }
        } else {
            $this->registerTelescope();
        }

        date_default_timezone_set(Config::get('app.timezone', 'Asia/Riyadh'));

        $this->viewComposers();
        $this->viewShareFunction();
        $this->loadRoutes();
        $this->loadViews();
        $this->loadMigration();
        $this->paginateArray();
    }

    private function viewComposers()
    {
        View::composer('dashboard.layouts.default', function (\Illuminate\View\View $view) {
            $view->with('sidebar', (new Sidebar())());
        });
        try {
            if (\Schema::hasTable('migrations') && \Schema::hasTable('languages') && \Schema::hasTable('settings')) {
                $allLanguages = Language::active()->get();
                View::composer('components.navbar.navbar', function ($view) use ($allLanguages) {
                    $languages = $allLanguages->where('code', '<>', get_current_lang());
                    $current = $allLanguages->where('code', get_current_lang())->first();
                    $view->with(['current' => $current, 'languages' => $languages]);
                });
                $general = setting('general');

                View::share(['languages' => $allLanguages, 'general' => $general]);
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    private function viewShareFunction()
    {
        $data_get = function ($target, $key, $default = null) {
            return data_get($target, $key, $default);
        };
        $session_get = function ($key) {
            return session($key);
        };

        View::share(['data_get' => $data_get, 'session_get' => $session_get]);
    }

    private function loadViews()
    {
        $modules_glob = glob(app_path() . '/Modules/**/resources/views');

        foreach ($modules_glob as $value) {
            $str = explode('/', substr($value, strpos($value, 'Modules')));

            $this->loadViewsFrom($value, $str[1]);
        }
    }

    private function loadRoutes()
    {
        $modules_glob = glob(app_path() . '/Modules/**/routes/*.php');

        foreach ($modules_glob as $value) {
            $str = explode('/', substr($value, strpos($value, 'Modules')));

            $this->loadRoutesFrom($value);
        }
    }

    private function loadMigration()
    {
        $migration_glob = glob(app_path() . '/Modules/**/database/migrations/*.php');
        foreach ($migration_glob as $file) {
            $file = edit_separator($file);
            $this->loadMigrationsFrom($file);
        }
    }

    private function paginateArray()
    {
        Collection::macro('paginateArray', function ($perPage, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage), // $items
                $this->count(),                  // $total
                $perPage,
                $page,
                [                                // $options
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }

    private function registerTelescope()
    {
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
    }
}
