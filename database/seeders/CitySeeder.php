<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     */
    public function run()
    {
        $cities = [
            ['name' => 'Lucknow', 'status' => 1],
            ['name' => 'Ayodhya', 'status' => 1],
            ['name' => 'Delhi', 'status' => 1],
            ['name' => 'Mumbai', 'status' => 1],
            ['name' => 'Bengaluru', 'status' => 1],
            ['name' => 'Hyderabad', 'status' => 1],
            ['name' => 'Ahmedabad', 'status' => 1],
            ['name' => 'Chennai', 'status' => 1],
            ['name' => 'Kolkata', 'status' => 1],
            ['name' => 'Pune', 'status' => 1],
            ['name' => 'Jaipur', 'status' => 1],
            ['name' => 'Chandigarh', 'status' => 1],
            ['name' => 'Bhopal', 'status' => 1],
            ['name' => 'Indore', 'status' => 1],
            ['name' => 'Patna', 'status' => 1],
        ];

        foreach ($cities as $city) {
            City::create([
                'id' => Str::uuid(),
                'name' => $city['name'],
                'state_id' => 1,
                'status' => $city['status'],
            ]);
        }
    }
}
