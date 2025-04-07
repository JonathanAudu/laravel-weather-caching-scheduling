# Laravel Weather Caching and Scheduling App

This Laravel application demonstrates **task scheduling** and **caching** with Redis while interacting with the **OpenWeatherMap API**. It uses scheduled tasks to delete old logs and clear cached weather data every hour.

## 🚀 Features

- Fetches weather data for a specified city from OpenWeatherMap API.
- Caches the weather data for 1 hour to improve response times.
- Logs all API requests, including request and response data, with timestamps.
- Automatically deletes logs older than 30 days using Laravel’s task scheduling.
- Clears weather cache every hour with a custom Artisan command.

## ⚡️ Requirements

- PHP 8.1 or higher
- Laravel 10.x
- Redis installed locally or on your server
- OpenWeatherMap API key

## 🛠️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/laravel-weather-caching-scheduling.git
cd laravel-weather-caching-scheduling
```

## 2.  Install Dependencies

Run the following command to install the Laravel dependencies:
```bash
composer install
```


## 3. Set Up the Environment File

Copy the .env.example file to .env:


## 4. Configure OpenWeatherMap API Key
- in your .env file paste
```env
- OPENWEATHERMAP_API_KEY=your_api_key_here
```
## 5. Configure Redis
```bash ```
```
- brew install redis
- brew services start redis
```
Then, set up Redis in your .env file:

```.env```
```
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## 6. Run Database Migrations
- Run the migrations to create the necessary tables:

```bash```
```
php artisan migrate
```


### 🔧 Running the Application
- Serve the application using Laravel's built-in server:

```bash
php artisan serve
Visit http://127.0.0.1:8000/api/weather/Abuja to get the weather for Abuja.
```


# 🔧 Artisan Commands
### Running the Scheduler
- To manually run scheduled tasks:

```bash```

```
php artisan schedule:run
```
### Clear Weather Cache Manually
- You can manually clear the cached weather data with:

```bash```
```
php artisan weather:clear-cache
```


# 📅 Task Scheduling
- The application uses Laravel's task scheduling to automate the following:

- Deletes logs older than 30 days: Runs daily at midnight.

- Clears weather cache: Runs every hour.

To ensure that tasks are scheduled automatically, add the following cron entry on your server:

```bash```
```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```


# 📝 License
- This project is open-source and available under the MIT License. See the LICENSE file for more details.