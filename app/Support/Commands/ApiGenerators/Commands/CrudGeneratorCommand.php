<?php

namespace App\Support\Commands\ApiGenerators\Commands;

use App\Support\Commands\CoreGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\ModelGeneratorCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudGeneratorCommand extends Command
{
    protected $signature = 'generate:crud {--core=} {--model=} {--M|migration}';

    protected $description = 'Generate a new crud';

    public function handle()
    {
        $controller = $this->getController();
        $core = $this->getCore();
        $model = $this->getModel();
        $resource = $this->getResource();
        $request = $this->getRequest();

        $this->info("Creating(Model)      :   App\Models\\{$model}");
        $this->info("Creating(Resource)      :   App\Http\Resources\Api\\{$resource}");
        $this->info("Creating(Request)      :   App\Http\Requests\Api\\{$request}");
        $this->info("Creating(Controller) :   App\Http\Controllers\Api\\{$core}\\{$controller}");

        if ($this->option('migration')) {
            $table = Str::snake(Str::pluralStudly($model));
            $migrationName = "create_{$table}_table";
            $this->callSilent('make:migration', [
                'name' => $migrationName,
                '--create' => $table,
            ]);
            $this->info("Creating(migration)       :   database/migrations/{$migrationName}");
        }
    }

    private function getCore(): ?string
    {
        return CoreGeneratorCommand::lastCreated();
    }

    private function getModel(): ?string
    {
        return ModelGeneratorCommand::lastCreated();
    }

    private function getResource(): ?string
    {
        return ResourceGeneratorCommand::lastCreated();
    }

    private function getRequest(): ?string
    {
        return RequestGeneratorCommand::lastCreated();
    }

    private function getController(): ?string
    {
        $this->runCommand(
            ControllerGeneratorCommand::class,
            [
                '--silence' => 1,
                '--core' => $this->option('core'),
                '--model' => $this->option('model'),
            ],
            $this->getOutput()
        );

        return ControllerGeneratorCommand::lastCreated();
    }
}
