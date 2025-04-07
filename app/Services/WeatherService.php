<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\ApiRequestLog;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    public function getWeather($city)
    {
        $cacheKey = "weather_{$city}";

        // Return cached data if available
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$this->apiKey}&units=metric";

        try {
            $response = $this->client->get($url);
            $data = json_decode($response->getBody(), true);

            // Log the API request
            ApiRequestLog::create([
                'endpoint' => $url,
                'request_data' => json_encode(['city' => $city]),
                'response_data' => json_encode($data),
                'status_code' => $response->getStatusCode()
            ]);

            // Cache the response for 1 hour
            Cache::put($cacheKey, $data, now()->addHour());

            return $data;
        } catch (\Exception $e) {
            // Log error
            ApiRequestLog::create([
                'endpoint' => $url,
                'request_data' => json_encode(['city' => $city]),
                'response_data' => $e->getMessage(),
                'status_code' => $e->getCode() ?: 500
            ]);

            return ['error' => $e->getMessage()];
        }
    }
}