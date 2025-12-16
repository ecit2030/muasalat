<?php

namespace App\Support\Commands\DashboardGenerators\Commands;

use App\Support\Commands\BaseGeneratorCommand;
use App\Support\Commands\CoreGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DatatableGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:datatable {core?} {model?} {--silence=0}';

    protected $description = 'Generate a new datatable for model';

    public function handle()
    {
        $modelName = $this->promptForArgument();
        $datatableName = self::$lastCreated;
        $core = CoreGeneratorCommand::lastCreated();
        $namespace = $this->getNamespace($core);
        $fullPath = $this->getFullPath($core, $datatableName);

        $this->buildClass($namespace, $fullPath, $modelName);
        ! $this->isSilence() && $this->info("Datatable {$namespace}\\{$datatableName} Created Successfully");
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
        static::$lastCreated = $modelName.'Datatable';

        return $modelName;
    }

    private function buildClass(string $namespace, string $path, string $name)
    {
        $modelPath = Str::of($namespace)
            ->replace('Datatables', 'Models')
            ->replace('Dashboard\\', '')
            ->replace('\\', '\\');

        $stub = Str::of(File::get(__DIR__.'/../Stubs/datatable.stub'))
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
        return "App\\Datatables\\Dashboard\\{$core}";
    }

    private function getFullPath(string $core, string $name)
    {
        return $this->makeDirectory($core).DIRECTORY_SEPARATOR.$name.'.php';
    }

    private function makeDirectory(string $core)
    {
        $path = $this->dataTablePath($core);
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
