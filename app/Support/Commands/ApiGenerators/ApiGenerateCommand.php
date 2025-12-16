<?php

namespace App\Support\Commands\ApiGenerators;

use App\Support\Commands\ApiGenerators\Commands\ControllerGeneratorCommand;
use App\Support\Commands\ApiGenerators\Commands\CrudGeneratorCommand;
use App\Support\Commands\ApiGenerators\Commands\RequestGeneratorCommand;
use App\Support\Commands\ApiGenerators\Commands\ResourceGeneratorCommand;
use App\Support\Commands\DashboardGenerators\Commands\ModelGeneratorCommand;
use Illuminate\Console\Command;

class ApiGenerateCommand extends Command
{
    protected $signature = 'api-generate';

    protected $description = 'Command line ui for generating api files';

    public function handle()
    {
        $generators = $this->getApiGenerators();
        $command = $this->choice(
            'What do you want to generate ?',
            array_keys($generators),
            'crud'
        );
        $this->runCommand($generators[$command], [], $this->getOutput());
    }

    private function getApiGenerators()
    {
        return [
            'crud' => CrudGeneratorCommand::class,
            'model' => ModelGeneratorCommand::class,
            'controller' => ControllerGeneratorCommand::class,
            'resource' => ResourceGeneratorCommand::class,
            'request' => RequestGeneratorCommand::class,
        ];
    }
}
