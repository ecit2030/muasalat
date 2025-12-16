<?php

namespace App\Support\Commands\FilterGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class GenerateFilterCommand extends GeneratorCommand
{
    protected string $ds = DIRECTORY_SEPARATOR;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new a filter';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'filter';

    protected function getStub()
    {
        return app_path('Support/Commands/FilterGenerator/Stubs/filter.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . $this->ds . 'Filters';
    }
}
