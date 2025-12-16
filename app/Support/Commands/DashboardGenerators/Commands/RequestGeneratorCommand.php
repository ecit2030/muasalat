<?php

namespace App\Support\Commands\DashboardGenerators\Commands;

use App\Support\Commands\BaseGeneratorCommand;
use App\Support\Commands\CoreGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RequestGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:request {core?} {model?} {--silence=0}';

    protected $description = 'Generate a new request for model';

    public function handle()
    {
        $modelName = $this->promptForArgument();
        $requestName = self::$lastCreated;
        $core = CoreGeneratorCommand::lastCreated();
        $namespace = $this->getNamespace($core);
        $fullPath = $this->getFullPath($core, $requestName);
        $this->buildClass($namespace, $fullPath, $modelName);
        ! $this->isSilence() && $this->info("Request {$namespace}\\{$requestName} Created Successfully");
    }

    private function promptForArgument(): string
    {
        $this->runCommand(
            ModelGeneratorCommand::class,
            [
                'name' => $this->argument('model'),
                'core' => $this->argument('core'),
                '--silence' => 1,
            ],
            $this->getOutput()
        );
        $modelName = ModelGeneratorCommand::lastCreated();
        static::$lastCreated = $modelName.'Request';

        return $modelName;
    }

    private function buildClass(string $namespace, string $path, string $name)
    {
        $modelPath = Str::of($namespace)
            ->replace('Request', 'Models')
            ->replace('Dashboard\\', '')
            ->replace('\\', '\\');

        $stub = Str::of(File::get(__DIR__.'/../Stubs/request.stub'))
            ->replace('{{ namespace }}', $namespace)
            ->replace('{{ model }}', $modelPath)
            ->replace('{{ modelName }}', $name)
            ->replace('{{ class }}', self::$lastCreated);

        if (! File::isFile($path)) {
            return File::put($path, $stub);
        }
    }

    private function getNamespace(string $core)
    {
        return "App\\Http\\Requests\\Dashboard\\{$core}";
    }

    private function getFullPath(string $core, string $name)
    {
        return $this->makeDirectory($core).DIRECTORY_SEPARATOR.$name.'.php';
    }

    private function makeDirectory(string $core)
    {
        $path = $this->dashboardRequestPath($core);
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
