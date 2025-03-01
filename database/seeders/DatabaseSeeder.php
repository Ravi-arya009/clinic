<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Clinic;
use App\Models\ClinicUser;
use App\Models\Doctor;
use App\Models\Qualification;
use App\Models\Speciality;
use App\Models\State;
use App\Models\SuperAdmin;
use App\Models\TimeSlot;
use App\Models\User;
use Faker\Provider\ar_EG\Address;
use Faker\Provider\ar_JO\Address as Ar_JOAddress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Laravel\Prompts\text;

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
        $this->call(MedicineMasterSeeder::class);
        $this->call(LabTestSeeder::class);

        // $this->call(ClinicSeeder::class);
        // $this->call(DoctorSeeder::class);
        // $this->call(FirstClinicDoctorsSeeder::class);
    }


    protected function createTestClinic()
    {
        $clinic =  Clinic::create([
            'id' => fake()->uuid,
            'name' => 'Test Clinic 1',
            'slug' => 'testclinic',
            'phone' => fake()->unique()->numerify('##########'),
            'contact_person' => fake()->name,
            'contact_person_phone' => fake()->unique()->numerify('##########'),
            'address' => fake()->address,
            'area' => fake()->city,
            'speciality_id' => Speciality::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'state_id' => State::inRandomOrder()->first()->id,
        ]);


        $admin = $this->createUser('Aman Ali', '8181000521'); //creating admin for this clinic for testing purposes

        $roles = \App\Models\Role::pluck('id', 'name')->toArray();
        $this->assignRole($admin->id, $clinic->id, $roles['admin']); // assigning user to this clinic and admin role
        $this->createTestDoctor($clinic->id);
    }

    protected function createTestDoctor($clinicId)
    {

        $doctor = $this->createUser('Jai Pratap', '8181000421'); //creating admin for this clinic for testing purposes

        $roles = \App\Models\Role::pluck('id', 'name')->toArray();
        $this->assignRole($doctor->id, $clinicId, $roles['doctor']); // assigning user to this clinic and admin role

        Doctor::create([
            'user_id' => $doctor->id,
            'bio' => 'Hi, My name is Jai Pratap and I am a test doctor.',
            'consultation_fee' => '690',
            'experience' => 8,
            'speciality_id' => Speciality::inRandomOrder()->first()->id,
            'qualification_id' => Qualification::inRandomOrder()->first()->id,
        ]);

        for ($i = 1; $i <= 7; $i++) {
            TimeSlot::create([
                'doctor_id' => $doctor->id,
                'clinic_id' => $clinicId,
                'slot_time' => '09:00:00',
                'day_of_week' => $i,
            ]);
        }
    }

    public function createUser($name, $phone)
    {
        $user = User::create([
            'id' => Str::uuid(),
            'name' => $name,
            'phone' => $phone,
            'whatsapp' => $phone,
            'email' => fake()->unique()->safeEmail,
            'state_id' => State::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'password' => Hash::make('ravi'),
            'pincode' => fake()->numerify('2260##'),
            'address' => fake()->address,
        ]);


        return $user;
    }

    public function assignRole($userId, $clinicId, $role,)
    {
        ClinicUser::create([
            'user_id' => $userId,
            'clinic_id' => $clinicId,
            'role_id' => $role,
        ]);
    }
}
