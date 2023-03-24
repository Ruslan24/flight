<?php

namespace App\Services\Flights\Contracts;

use App\Models\Flight;

/**
 * Interface FlightServiceInterface
 * @package App\Services\Faq\Contracts
 */
interface FlightServiceInterface
{
    /**
     * Search flight data.
     *
     * @param array $filters
     * @return Flight|bool
     */
    public function search(array $filters): mixed;
}
