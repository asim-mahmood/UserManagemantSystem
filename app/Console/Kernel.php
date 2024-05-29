<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\CheckBillingStatus;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command(CheckBillingStatus::class)->everyMinute();
        // $schedule->command(CheckBillingStatus::class)->dailyAt('00:00');

        $schedule->command('bills:pay')->monthlyOn(1, '00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        // Comment out the following line or remove it
        // $this->commands([
        //     CheckBillingStatus::class,
        // ]);

        require base_path('routes/console.php');
    }
}
