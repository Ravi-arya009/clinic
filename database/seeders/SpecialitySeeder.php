<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialities = [
            ['name' => 'Cardiology', 'image' => 'specialities-01.svg', 'status' => 1],
            ['name' => 'Neurology', 'image' => 'specialities-02.svg', 'status' => 1],
            ['name' => 'Urology', 'image' => 'specialities-03.svg', 'status' => 1],
            ['name' => 'Orthopedic', 'image' => 'specialities-04.svg', 'status' => 1],
            ['name' => 'Dentist', 'image' => 'specialities-05.svg', 'status' => 1],
            ['name' => 'Ophthalmology', 'image' => 'specialities-06.svg', 'status' => 1],
        ];

        foreach ($specialities as $speciality) {
            Speciality::create([
                'id' => Str::uuid(),
                'name' => $speciality['name'],
                'image' => $speciality['image'],
                'status' => $speciality['status'],
            ]);
        }
    }
}
