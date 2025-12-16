<?php

namespace App\Support\Commands\DashboardGenerators\Commands;

use App\Support\Commands\BaseGeneratorCommand;
use App\Support\Commands\CoreGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ControllerGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:controller {name?} {--core=} {--model=} {--datatable=} {--empty=} {--silence=0}';

    protected $description = 'Generate a new controller';

    protected string $core;

    protected string $controller;

    protected string $model;

    protected string $datatable;

    protected string $formRequest;

    public function handle()
    {
        $this->model = $this->promptForModel();
        $this->core = $this->promptForCore();
        $this->datatable = $this->promptForDatatable();
        $this->formRequest = $this->promptForRequest();

        static::$lastCreated = $this->controller = $this->promptForArgument($this->argument('name'));
        $this->makeDirectory();
        $this->buildClass();

        ! $this->isSilence() && $this->info("Controller {$this->getNamespace()}\\{$this->controller} Created Successfully");
    }

    private function promptForArgument($value = null): string
    {
        if (! $this->option('empty')) {
            return $this->model.'Controller';
        }
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArgument($this->ask('Please Enter a valid controller name'));
            }

            return Str::of($value)
                ->singular()
                ->studly()
                ->append('Controller');
        }

        $question = $this->ask('Please enter controller name');

        return $this->promptForArgument($question);
    }

    private function promptForCore()
    {
        return CoreGeneratorCommand::lastCreated();
    }

    private function buildClass()
    {
        $path = $this->getFullPath();
        $stub = $this->option('empty') ? __DIR__.'/../Stubs/controller.stub' : __DIR__.'/../Stubs/controller.crud.stub';
        $stub = Str::of(File::get($stub))
            ->replace('{{ namespace }}', $this->getNamespace())
            ->replace('{{ model }}', $this->model)
            ->replace('{{ core }}', $this->core)
            ->replace('{{ formRequest }}', $this->formRequest)
            ->replace('{{ path }}', $this->viewPathName($this->core, $this->model))
            ->replace('{{ class }}', $this->controller);

        if (! $this->option('empty')) {
            $stub = $stub->replace('{{ datatable }}', $this->datatable);
        }
        if (! File::isFile($path)) {
            File::put($path, $stub);
        }
    }

    private function getNamespace(): string
    {
        return "App\\Http\\Controllers\\Dashboard\\{$this->core}";
    }

    private function getFullPath(): string
    {
        return $this->dashboardControllerPath($this->core).DIRECTORY_SEPARATOR.$this->controller.'.php';
    }

    private function promptForModel(): ?string
    {
        $this->runCommand(
            ModelGeneratorCommand::class,
            [
                'name' => $this->option('model'),
                'core' => $this->option('core'),
                '--silence' => 1,
            ],
            $this->getOutput()
        );

        return ModelGeneratorCommand::lastCreated();
    }

    private function promptForDatatable(): ?string
    {
        if ($this->option('empty')) {
            return null;
        }
        $this->runCommand(
            DatatableGeneratorCommand::class,
            [
                'core' => $this->core,
                'model' => $this->model,
                '--silence' => 1,
            ],
            $this->getOutput()
        );

        return DatatableGeneratorCommand::lastCreated();
    }

    private function promptForRequest(): ?string
    {
        if ($this->option('empty')) {
            return null;
        }
        $this->runCommand(
            RequestGeneratorCommand::class,
            [
                'core' => $this->core,
                'model' => $this->model,
                '--silence' => 1,
            ],
            $this->getOutput()
        );

        return RequestGeneratorCommand::lastCreated();
    }

    private function makeDirectory(): string
    {
        $path = $this->dashboardControllerPath($this->core);
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
