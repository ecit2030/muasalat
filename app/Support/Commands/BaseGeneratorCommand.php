<?php

namespace App\Support\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BaseGeneratorCommand extends Command
{
    protected string $ds = DIRECTORY_SEPARATOR;

    public function handle()
    {
        $this->warn('This command is not implemented yet');
    }

    public function corePath(?string $core = null, ?string $path = null): string
    {
        return app_path('Core').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    public function dataTablePath(?string $core = null, ?string $path = null): string
    {
        return app_path('Datatables/Dashboard').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    public function modelPath(?string $core = null, ?string $path = null): string
    {
        return app_path('Models/').($path ? $this->ds.$path : '');
    }

    public function apiControllerPath(?string $core = null, ?string $path = null): string
    {
        return app_path('Http/Controllers/Api').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    public function apiResourcePath(?string $core = null, ?string $path = null): string
    {
        return app_path('Http/Resources/Api').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    public function apiRequestPath(?string $core = null, ?string $path = null): string
    {
        return app_path('Http/Requests/Api').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    public function dashboardControllerPath(?string $core = null, ?string $path = null): string
    {
        return app_path('Http/Controllers/Dashboard').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    public function dashboardRequestPath(?string $core = null, ?string $path = null): string
    {
        return app_path('Http/Requests/Dashboard').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    public function viewPath(?string $core = null, ?string $path = null): string
    {
        return resource_path('views/dashboard').($core ? $this->ds.$core : '').($path ? $this->ds.$path : '');
    }

    protected function isSilence()
    {
        return $this->option('silence') > 0;
    }

    protected function viewPathName(string $core, string $name)
    {
        return 'dashboard.'.Str::kebab($core).'.'.Str::of($name)
            ->replace('Model', '')
            ->plural()
            ->kebab();
    }

    protected function apiRouteName(string $core, string $name)
    {
        return 'api.'.Str::kebab($core).'.'.Str::of($name)
            ->replace('Model', '')
            ->plural()
            ->kebab();
    }
}
