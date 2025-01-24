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
            ['name' => 'Neurology', 'status' => 1],
            ['name' => 'Orthopedics', 'status' => 1],
            ['name' => 'Cardiology', 'status' => 1],
            ['name' => 'Dermatology', 'status' => 1],
            ['name' => 'Pediatrics', 'status' => 1],
            ['name' => 'Psychiatry', 'status' => 1],
            ['name' => 'Gynecology', 'status' => 1],
            ['name' => 'Urology', 'status' => 1],
            ['name' => 'Ophthalmology', 'status' => 1],
            ['name' => 'ENT (Ear, Nose, Throat)', 'status' => 1],
            ['name' => 'General Medicine', 'status' => 1],
            ['name' => 'Oncology', 'status' => 1],
            ['name' => 'Pulmonology', 'status' => 1],
            ['name' => 'Endocrinology', 'status' => 1],
            ['name' => 'Gastroenterology', 'status' => 1],
        ];

        foreach ($specialities as $speciality) {
            Speciality::create([
                'id' => Str::uuid(),
                'name' => $speciality['name'],
                'status' => $speciality['status'],
            ]);
        }
    }
}
