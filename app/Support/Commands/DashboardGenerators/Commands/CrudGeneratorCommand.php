<?php

namespace App\Support\Commands\DashboardGenerators\Commands;

use App\Support\Commands\CoreGeneratorCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudGeneratorCommand extends Command
{
    protected $signature = 'generate:crud {--core=} {--model=} {--M|migration}';

    protected $description = 'Generate a new crud';

    public function handle()
    {
        $controller = $this->getController();
        $datatable = $this->getDatatable();
        $request = $this->getRequest();
        $core = $this->getCore();
        $model = $this->getModel();
        $view = Str::replace('.', '/', $this->getView($core, $model));

        $this->info("Creating(Model)      :   App\Models\\{$model}");
        $this->info("Creating(Datatable)  :   App\Datatables\\{$core}\\{$datatable}");
        $this->info("Creating(Request)  :   App\Http\Requests\Dashboard\\{$core}\\{$request}");
        $this->info("Creating(Controller) :   App\Http\Controllers\Dashboard\\{$core}\\{$controller}");
        $this->info("Creating(View)       :   views/{$view}");
        $this->createFormView($core, $model);
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

    private function getView($core, $model): ?string
    {
        $this->runCommand(
            ViewGeneratorCommand::class,
            [
                'core' => $core,
                'name' => $model,
                '--silence' => 1,
            ],
            $this->getOutput()
        );

        return ViewGeneratorCommand::lastCreated();
    }

    private function getModel(): ?string
    {
        return ModelGeneratorCommand::lastCreated();
    }

    private function getDatatable(): ?string
    {
        return DatatableGeneratorCommand::lastCreated();
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

    private function createFormView($core, $model)
    {
        $this->callSilent(
            ViewFormGeneratorCommand::class,
            ['core' => $core, 'name' => $model, '--silence' => 1]
        );
    }
}
