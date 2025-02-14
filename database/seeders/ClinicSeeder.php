<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     // Clinic::factory(25)->create();

    // }

    public function run(): void
    {
        Clinic::factory(25)->afterCreating(function (Clinic $clinic) {
            // User::factory()->create([
            //     'id' => Str::uuid(),
            //     'name' => fake()->name(),
            //     'phone' => fake()->unique()->numerify('##########'),
            //     'role' => '5bae8dc5-6997-40f3-8299-6ff0e36817fb',
            //     'clinic_id' => $clinic->id,
            //     'password' => Hash::make('ravi'),
            // ]);
        })->create();
    }
}

