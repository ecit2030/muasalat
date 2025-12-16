<?php

namespace App\Support\Commands\DashboardGenerators;

use App\Support\Commands\DashboardGenerators\Commands\ControllerGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\CrudGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\DatatableGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\ModelGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\RequestGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\ViewFormGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\ViewGeneratorCommand;
use Illuminate\Console\Command;

class WebGenerateCommand extends Command
{
    protected $signature = 'generate';

    protected $description = 'Command line ui for generating files';

    public function handle()
    {
        $generators = $this->getGenerators();
        $command = $this->choice(
            'What do you want to generate ?',
            array_keys($generators),
            'crud'
        );
        $this->runCommand($generators[$command], [], $this->getOutput());
    }

    private function getGenerators()
    {
        return [
            'crud' => CrudGeneratorCommand::class,
            'model' => ModelGeneratorCommand::class,
            'controller' => ControllerGeneratorCommand::class,
            'datatable' => DatatableGeneratorCommand::class,
            'request' => RequestGeneratorCommand::class,
            'view' => ViewGeneratorCommand::class,
            'view-form' => ViewFormGeneratorCommand::class,
        ];
    }
}
