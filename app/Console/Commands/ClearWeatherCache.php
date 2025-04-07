<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class ClearWeatherCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:clear-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all cached weather data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedCount = 0;

        foreach (Cache::getRedis()->keys('weather_*') as $key) {
            Cache::getRedis()->del($key);
            $deletedCount++;
        }

        $this->info("Cleared $deletedCount weather cache entries.");
        return 0;
    }
}
