<?php

namespace Database\Seeders;

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\Transporter;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!is_null(Flight::first())) {
            return;
        }
        $faker = Faker::create();
        $transporters = Transporter::all();
        foreach ($transporters as $transporter) {


            $count = rand(20, 40);
            $flights = [];

            for ($i = 0; $i < $count; $i++) {
                $duration = rand(40, 240);
                $departureDateTime = $faker->dateTimeBetween('-1 week', '+1 week');
                $arrivalDateTime = Carbon::createFromFormat(
                    'Y-m-d H:i:s', $departureDateTime->format('Y-m-d H:i:s')
                )->addMinutes($duration);

                $flights[] = [
                    'transporter_id' => $transporter->id,
                    'flight_number' => $faker->unique()->regexify('[A-Z]{2}[0-9]{4}'),
                    'departure_airport' => $faker->randomElement(['JFK', 'LAX', 'SFO', 'ORD']),
                    'arrival_airport' => $faker->randomElement(['JFK', 'LAX', 'SFO', 'ORD']),
                    'departure_date_time' => $departureDateTime->format('Y-m-d H:i:s'),
                    'arrival_date_time' => $arrivalDateTime->format('Y-m-d H:i:s'),
                    'duration' => $duration,
                ];
            }

            Flight::insert($flights);
        }
    }
}

