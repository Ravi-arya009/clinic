<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Qualification;
use App\Models\Speciality;
use App\Models\State;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FirstClinicDoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $clinic = Clinic::first();

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->unique()->numerify('##########'),
                'whatsapp' => fake()->unique()->numerify('##########'),
                'gender' => fake()->numberBetween(1, 2),
                'state_id' => State::inRandomOrder()->first()->id,
                'city_id' => City::inRandomOrder()->first()->id,
                'area' => fake()->city,
                'address' => fake()->address,
                'pincode' => fake()->numerify('######'),
                'role' => 2,
                'clinic_id' => $clinic->id,
                'email_verified_at' => now(),
                'password' => Hash::make('ravi'),
                'remember_token' => Str::random(10),
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'experience' => fake()->numberBetween(1, 20),
                'speciality_id' => Speciality::inRandomOrder()->first()->id,
                'qualification_id' => Qualification::inRandomOrder()->first()->id,
                'consultation_fee' => fake()->numberBetween(100, 1000),
                'bio' => fake()->paragraph,
            ]);

            for ($j = 0; $j < 10; $j++) {
                TimeSlot::create([
                    'id' => Str::uuid(),
                    'doctor_id' => $user->id,
                    'clinic_id' => $clinic->id,
                    'slot_time' => fake()->time(),
                    'day_of_week' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7]),
                ]);
            }
        }
    }
}
