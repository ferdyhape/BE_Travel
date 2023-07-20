<?php

namespace Database\Seeders;

use App\Models\Travel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            Travel::create([
                'name' => 'Travel ' . $i,
                'email' => $faker->email,
                'address' => $faker->address,
                'phone_number' => '0878658252' . $i,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            ]);
        }
    }
}
