<?php

namespace App\Support\Commands\ApiGenerators\Commands;

use App\Support\Commands\BaseGeneratorCommand;
use App\Support\Commands\CoreGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\ModelGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ResourceGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:api-resource {core?} {model?} {--silence=0}';

    protected $description = 'Generate a new resource for model';

    public function handle()
    {
        $modelName = $this->promptForArgument();
        $resourceName = self::$lastCreated;
        $core = CoreGeneratorCommand::lastCreated();
        $namespace = $this->getNamespace($core);
        $fullPath = $this->getFullPath($core, $resourceName);
        $this->buildClass($namespace, $fullPath, $modelName);
        ! $this->isSilence() && $this->info("Resource {$namespace}\\{$resourceName} Created Successfully");
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
        static::$lastCreated = $modelName.'Resource';

        return $modelName;
    }

    private function buildClass(string $namespace, string $path, string $name)
    {
        $modelPath = Str::of($namespace)
            ->replace('Resources', 'Models')
            ->replace('Dashboard\\', '')
            ->replace('\\', '\\');

        $stub = Str::of(File::get(__DIR__.'/../Stubs/resource.stub'))
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
        return "App\\Http\\Resources\\Api\\{$core}";
    }

    private function getFullPath(string $core, string $name)
    {
        return $this->makeDirectory($core).DIRECTORY_SEPARATOR.$name.'.php';
    }

    private function makeDirectory(string $core)
    {
        $path = $this->apiResourcePath($core);
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
