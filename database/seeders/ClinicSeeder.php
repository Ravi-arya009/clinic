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
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClinicSeeder extends Seeder
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function run(): void
    {
        try {
            Clinic::factory(25)->afterCreating(function (Clinic $clinic) {
                User::factory()->create([
                    'id' => Str::uuid(),
                    'name' => fake()->name(),
                    'phone' => fake()->unique()->numerify('##########'),
                    'role_id' =>  $this->roleService->fetchRoleIdByName('admin'),
                    'clinic_id' => $clinic->id,
                    'password' => Hash::make('ravi'),
                ]);
            })->create();

            $this->createTestClinic();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createTestClinic()
    {
        $testClinic =  Clinic::create([
            'id' => fake()->uuid,
            'name' => 'Test Clinic 1',
            'slug' => 'testclinic',
            'phone' => fake()->unique()->numerify('##########'),
            'contact_person' => fake()->name,
            'contact_person_phone' => fake()->unique()->numerify('##########'),
            'address' => fake()->address,
            'area' => fake()->city,
            'speciality_id' => Speciality::inRandomOrder()->first()->id, // Fetching a random speciality
            'city_id' => City::inRandomOrder()->first()->id, // Fetching a random city
            'state_id' => State::inRandomOrder()->first()->id, // Fetching a random state
        ]);

        //creating admin for this clinic for testing purposes
        User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'Aman Ali',
            'phone' => '8181000521',
            'role_id' =>  $this->roleService->fetchRoleIdByName('admin'),
            'clinic_id' => $testClinic->id,
            'password' => Hash::make('ravi'),
        ]);


        //creating doctor for this clinic for tesing purposes
        $myDoctor = User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'Jai Pratap',
            'phone' => '8181000421',
            'role_id' =>  $this->roleService->fetchRoleIdByName('doctor'),
            'clinic_id' => $testClinic->id,
            'password' => Hash::make('ravi'),
        ]);

        Doctor::create([
            'user_id' => $myDoctor->id,
            'experience' => fake()->numberBetween(1, 20),
            'speciality_id' => Speciality::inRandomOrder()->first()->id,
            'qualification_id' => Qualification::inRandomOrder()->first()->id,
            'consultation_fee' => fake()->numberBetween(100, 1000),
            'bio' => fake()->paragraph,
        ]);
    }
}
