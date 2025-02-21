<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Clinic;
use App\Models\ClinicUser;
use App\Models\Speciality;
use App\Models\State;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $this->call(SuperAdminSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(SpecialitySeeder::class);
        $this->call(QualificationSeeder::class);
        $this->createTestClinic();

        // $this->call(QualificationSeeder::class);
        // $this->call(ClinicSeeder::class);
        // $this->call(MedicineMasterSeeder::class);
        // $this->call(DoctorSeeder::class);
        // $this->call(FirstClinicDoctorsSeeder::class);
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
        $user = User::create([
            'id' => Str::uuid(),
            'name' => 'Aman Ali',
            'phone' => '8181000521',
            'password' => Hash::make('ravi'),
        ]);

        $roles = \App\Models\Role::pluck('id', 'name')->toArray();

        // assigning user to this clinic and admin role
        ClinicUser::create([
            'user_id' => $user->id,
            'clinic_id' => $testClinic->id,
            'role_id' => $roles['admin'],

        ]);
    }
}
