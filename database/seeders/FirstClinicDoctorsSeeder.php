<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Qualification;
use App\Models\Speciality;
use App\Models\State;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FirstClinicDoctorsSeeder extends Seeder
{
    use HasUuids;
    /**
     * Run the database seeds.
     * This is a temporary seeder created to fill dummy clinic, doctor and timeslot.
     * This will not make in production.
     */

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

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
                'address' => fake()->address,
                'pincode' => fake()->numerify('######'),
                'role_id' =>  $this->roleService->fetchRoleIdByName('doctor'),
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
        }
    }
}
