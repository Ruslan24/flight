<?php

namespace App\Services\Flights\Repositories;

use App\Models\Flight;
use App\Repositories\Repository;
use App\Services\Flights\Contracts\FlightRepositoryInterface;

class FlightRepository extends Repository implements FlightRepositoryInterface
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Flight::class;
    }
}
