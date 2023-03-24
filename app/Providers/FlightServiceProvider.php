<?php

namespace App\Providers;

use App\Services\Flights\Contracts\FlightServiceInterface;
use App\Services\Flights\Contracts\FlightRepositoryInterface;
use App\Services\Flights\FlightService;
use App\Services\Flights\Repositories\FlightRepository;
use Illuminate\Support\ServiceProvider;

class FlightServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( FlightServiceInterface::class, FlightService::class);
        $this->app->bind( FlightRepositoryInterface::class, FlightRepository::class);
    }

}
