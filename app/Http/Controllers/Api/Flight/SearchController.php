<?php

namespace App\Http\Controllers\Api\Flight;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\SearchQueryRequest;
use App\Services\Flights\Contracts\FlightServiceInterface;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    /**
     * Search flights.
     *
     * @param SearchQueryRequest $request
     * @param FlightServiceInterface $flightService
     * @return JsonResponse
     */
    public function __invoke(SearchQueryRequest $request, FlightServiceInterface $flightService)
    {
        $filters = [
            'departureAirport' => trim($request->input('searchQuery')['departureAirport']),
            'arrivalAirport' => trim($request->input('searchQuery')['arrivalAirport']),
            'departureDate' => trim($request->input('searchQuery')['departureDate']),
        ];

        $flights = $flightService->search($filters);

        return response()->json($flightService->preparationData($request->input(), $flights));
    }
}
