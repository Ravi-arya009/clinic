<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            'Lucknow',
            'Ayodhya',
            'Delhi',
            'Mumbai',
            'Bengaluru',
            'Hyderabad',
            'Ahmedabad',
            'Chennai',
            'Kolkata',
            'Pune',
            'Jaipur',
            'Chandigarh',
            'Bhopal',
            'Indore',
            'Patna',
        ];

        foreach ($cities as $city) {
            City::firstOrCreate([
                'id' => Str::uuid(),
                'name' => $city,
                'state_id' => 1,
            ]);
        }
    }
}
