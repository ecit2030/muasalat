<?php

namespace App\Support\Commands\DashboardGenerators\Commands;

use App\Support\Commands\BaseGeneratorCommand;
use App\Support\Commands\CoreGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:model {core?} {name?} {--M|migration} {--silence=0}';

    protected $description = 'Generate a new crud';

    public function handle()
    {
        $core = $this->promptForCore();
        $name = $this->promptForArgument($this->argument('name'));
        $namespace = $this->getNamespace($core);
        $fullPath = $this->getFullPath($core, $name);

        $this->buildClass($namespace, $fullPath, $name);
        ! $this->isSilence() && $this->info("Model {$namespace}\\{$name} Created Successfully");
        if ($this->option('migration')) {
            $table = Str::snake(Str::pluralStudly($name));
            $migrationName = "create_{$table}_table";
            $this->callSilent('make:migration', [
                'name' => $migrationName,
                '--create' => $table,
            ]);
            $this->info("Creating(migration)       :   database/migrations/{$migrationName}");
        }
    }

    private function promptForArgument($value = null): string
    {
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArgument($this->ask('Please Enter a valid model name'));
            }
            $value = Str::of($value)
                ->singular()
                ->studly();

            return static::$lastCreated = $value;
        }

        $question = $this->ask('Please enter model name');

        return $this->promptForArgument($question);
    }

    private function promptForCore()
    {
        $this->runCommand(
            CoreGeneratorCommand::class,
            ['name' => $this->argument('core'), '--silence' => 1],
            $this->getOutput()
        );

        return CoreGeneratorCommand::lastCreated();
    }

    private function makeDirectory(string $core)
    {
        $path = $this->modelPath($core);

        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    private function buildClass(string $namespace, string $path, string $name)
    {
        $stub = Str::of(File::get(__DIR__.'/../Stubs/model.stub'))
            ->replace('{{ namespace }}', $namespace)
            ->replace('{{ class }}', $name);
        if (! File::isFile($path)) {
            return File::put($path, $stub);
        }
    }

    private function getNamespace(string $core)
    {
        return 'App\\Models';
    }

    private function getFullPath(string $core, string $name)
    {
        return $this->makeDirectory($core).DIRECTORY_SEPARATOR.$name.'.php';
    }
}
