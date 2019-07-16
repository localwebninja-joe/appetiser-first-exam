<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EventCalendar\EloquentEventCalendarRepository;
use App\Repositories\EventCalendar\EventCalendarRepository;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(EventCalendarRepository::class, EloquentEventCalendarRepository::class);
    }
}
