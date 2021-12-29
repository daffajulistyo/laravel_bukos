<?php

namespace Database\Seeders;

use App\Models\BoardingHouse;
use Illuminate\Database\Seeder;

class BoardingHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoardingHouse::truncate();
        BoardingHouse::create([
            'name' => 'Kost Ex',
            'location' => 'Padang',
            'description' => 'Example',
            'price' => 500000,
            'discount' => 5,

            'years' => 1,
            'latitude' => '-7.821523',

            'longitude' => '110.441544',

        ]);
    }
}
