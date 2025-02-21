<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialitySeeder extends Seeder
{
    public function run()
    {
        $specialities = [
            ['name' => 'Cardiology', 'image' => 'specialities-01.svg'],
            ['name' => 'Neurology', 'image' => 'specialities-02.svg'],
            ['name' => 'Urology', 'image' => 'specialities-03.svg'],
            ['name' => 'Orthopedic', 'image' => 'specialities-04.svg'],
            ['name' => 'Dentist', 'image' => 'specialities-05.svg'],
            ['name' => 'Ophthalmology', 'image' => 'specialities-06.svg'],
        ];

        foreach ($specialities as $speciality) {
            Speciality::create([
                'id' => Str::uuid(),
                'name' => $speciality['name'],
                'image' => $speciality['image'],
            ]);
        }
    }
}
