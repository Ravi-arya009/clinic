<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['name' => 'Andhra Pradesh', 'status' => 1],
            ['name' => 'Arunachal Pradesh', 'status' => 1],
            ['name' => 'Assam', 'status' => 1],
            ['name' => 'Bihar', 'status' => 1],
            ['name' => 'Chhattisgarh', 'status' => 1],
            ['name' => 'Goa', 'status' => 1],
            ['name' => 'Gujarat', 'status' => 1],
            ['name' => 'Haryana', 'status' => 1],
            ['name' => 'Himachal Pradesh', 'status' => 1],
            ['name' => 'Jharkhand', 'status' => 1],
            ['name' => 'Karnataka', 'status' => 1],
            ['name' => 'Kerala', 'status' => 1],
            ['name' => 'Madhya Pradesh', 'status' => 1],
            ['name' => 'Maharashtra', 'status' => 1],
            ['name' => 'Manipur', 'status' => 1],
            ['name' => 'Meghalaya', 'status' => 1],
            ['name' => 'Mizoram', 'status' => 1],
            ['name' => 'Nagaland', 'status' => 1],
            ['name' => 'Odisha', 'status' => 1],
            ['name' => 'Punjab', 'status' => 1],
            ['name' => 'Rajasthan', 'status' => 1],
            ['name' => 'Sikkim', 'status' => 1],
            ['name' => 'Tamil Nadu', 'status' => 1],
            ['name' => 'Telangana', 'status' => 1],
            ['name' => 'Tripura', 'status' => 1],
            ['name' => 'Uttar Pradesh', 'status' => 1],
            ['name' => 'Uttarakhand', 'status' => 1],
            ['name' => 'West Bengal', 'status' => 1],
        ];

        foreach ($states as $state) {
            State::create([
                'id' => Str::uuid(),
                'name' => $state['name'],
                'status' => $state['status'],
            ]);
        }
    }
}
