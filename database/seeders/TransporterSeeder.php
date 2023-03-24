<?php

namespace Database\Seeders;

use App\Models\Transporter;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!is_null(Transporter::first())) {
            return;
        }
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Transporter::create([
                'code' => $faker->unique()->regexify('[A-Z]{1}[0-9]{1}'),
                'name' => $faker->company(),
            ]);
        }
    }
}
