<?php

namespace App\Services\Flights;

use App\Models\Flight;
use App\Services\BaseService;
use App\Services\Flights\Contracts\FlightRepositoryInterface;
use App\Services\Flights\Contracts\FlightServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;

class FlightService extends BaseService implements FlightServiceInterface
{
    /**
     * @param DatabaseManager $databaseManager
     * @param Logger $logger
     * @param FlightRepositoryInterface $flightRepository
     */
    public function __construct(
        DatabaseManager           $databaseManager,
        Logger                    $logger,
        FlightRepositoryInterface $flightRepository
    )
    {
        parent::__construct($databaseManager, $logger, $flightRepository);
    }

    /**
     * Search flights by filters
     *
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters): mixed
    {
        $from = $filters['departureDate'] . ' 00.00.00';
        $to = $filters['departureDate'] . ' 23.59.59';

        $query = Flight::with('transporter')
            ->where('departure_airport', $filters['departureAirport'])
            ->where('arrival_airport', $filters['arrivalAirport'])
            ->whereBetween('departure_date_time', [$from, $to])
            ->orderBy('departure_date_time', 'asc');

        return $query->get();
    }


    /**
     * Preparation data for search
     *
     * @param array $requestData
     * @param mixed $flights
     * @return array
     */
    public function preparationData(array $requestData, mixed $flights): array
    {
        $data = [
            'searchQuery' => $requestData['searchQuery'],
            'searchResults' => []
        ];

        if (empty($flights)) {
            return $data;
        }

        $arrayFlights = [];
        foreach ($flights as $flight) {
            $arrayFlights[] = [
                'transporter' => [
                    'code' => $flight?->transporter?->code,
                    'name' => $flight?->transporter?->name,
                ],
                'flightNumber' => $flight->flight_number,
                'departureAirport' => $flight->departure_airport,
                'arrivalAirport' => $flight->arrival_airport,
                'departureDateTime' => Carbon::parse($flight->departure_date_time)->format('Y-m-d H:i:s'),
                'arrivalDateTime' => Carbon::parse($flight->arrival_date_time)->format('Y-m-d H:i:s'),
                'duration' => $flight->duration,
            ];
        }
        $data['searchResults'] = $arrayFlights;

        return $data;
    }
}
