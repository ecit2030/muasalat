<?php

namespace App\Console;

use App\Console\Commands\CancelTripCommand;
use App\Console\Commands\EndTripCommand;
use App\Console\Commands\TripIsOnNotificationCommand;
use App\Support\Commands\ApiGenerators\ApiGenerateCommand;
use App\Support\Commands\DashboardGenerators\WebGenerateCommand;
use App\Support\Commands\FilterGenerator\Commands\GenerateFilterCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        WebGenerateCommand::class,
        ApiGenerateCommand::class,
        GenerateFilterCommand::class,
        TripIsOnNotificationCommand::class,
        EndTripCommand::class,
        CancelTripCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune --hours=48')->daily();
        // $schedule->command('trip:start')->everyMinute();
        // $schedule->command('trip:check')->everyThirtyMinutes();
        // $schedule->command('trip:finish')->everyTenMinutes();
        // $schedule->command('trip:cancel')->everyMinute();
        $schedule->command('trip:cancel-if-client-not-paid')->everyMinute();
        $schedule->command('queue:restart')->everyMinute();
        $schedule->command('queue:work --daemon --queue=default --tries=3')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
