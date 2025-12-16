<?php

namespace App\Support\Commands;

use App\Support\Commands\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CoreGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:core {name?} {--silence=}';

    protected $description = 'Generate a new Core';

    public function handle()
    {
        $name = $this->promptForArguments($this->argument('name'));
        $silence = $this->isSilence();
        //$this->makeDirectory($name);
        ! $silence && $this->info("Core {$name} created Successfully");
    }

    public function exist($name)
    {
        return File::exists($name);
    }

    private function makeDirectory(string $Core)
    {
        $path = $this->CorePath($Core);
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }

    private function promptForArguments($value = null)
    {
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArguments($this->ask('Please Enter a valid Core name'));
            }

            return static::$lastCreated = Str::of($value)->singular()->studly();
        }

        $question = $this->ask('Please Enter Core name');

        return $this->promptForArguments($question);
    }
}
