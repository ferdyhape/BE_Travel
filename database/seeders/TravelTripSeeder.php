<?php

namespace Database\Seeders;

use App\Models\Travel;
use App\Models\TravelTrip;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TravelTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = ['Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta', 'Malang', 'Bali', 'Medan', 'Palembang', 'Makassar'];
        $price = [100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000];
        $departure_hours = 0;
        $arrival_hours = 1;
        foreach (Travel::all() as $travel) {
            $departure_hours += 1;
            $arrival_hours += 1;
            for ($i = 0; $i < 2; $i++) {
                TravelTrip::create([
                    'departure_time' => $departure_hours . ':00:00',
                    'arrival_time' => $arrival_hours . ':00:00',
                    'departure_city' => $city[array_rand($city)],
                    'destination_city' => $city[array_rand($city)],
                    'price' => $price[rand(0, count($price) - 1)],
                    'travel_id' => $travel->id,
                ]);
            }
        }
    }
}
