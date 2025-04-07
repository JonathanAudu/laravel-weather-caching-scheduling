<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Delete logs older than 30 days daily
        $schedule->call(function () {
            \App\Models\ApiRequestLog::where('created_at', '<', now()->subDays(30))->delete();
        })->daily();

        // Clear weather cache every hour
        $schedule->command('weather:clear-cache')->hourly();
    }

    protected $commands = [
        \App\Console\Commands\ClearWeatherCache::class,
    ];

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
