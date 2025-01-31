<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Role;
use App\Models\SuperAdmin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory()->create([
        //     'id' => Str::uuid(),
        //     'name' => 'Admin',
        //     'phone' => '8181000621',
        //     'whatsapp' => '8181000621',
        //     'password' => Hash::make('ravi'),
        //     'role' => 1,
        //     'gender' => 1
        // ]);

        // User::factory()->create([
        //     'id' => Str::uuid(),
        //     'name' => 'Doctor',
        //     'phone' => '8181000721',
        //     'password' => Hash::make('ravi'),
        //     'role' => 2,
        //     'gender' => 1

        // ]);

        // User::factory()->create([
        //     'id' => Str::uuid(),
        //     'name' => 'Staff',
        //     'phone' => '8181000821',
        //     'password' => Hash::make('ravi'),
        //     'role' => 3,
        //     'gender' => 1
        // ]);

        // User::factory()->create([
        //     'id' => Str::uuid(),
        //     'name' => 'patient',
        //     'phone' => '8181000921',
        //     'password' => Hash::make('ravi'),
        //     'role' => 4,
        //     'gender' => 1
        // ]);

        Role::create([
            'role_name' => 'admin',
            'role_id' => Str::uuid()
        ]);
        Role::create([
            'role_name' => 'doctor',
            'role_id' => Str::uuid()
        ]);
        Role::create([
            'role_name' => 'staff',
            'role_id' => Str::uuid()
        ]);
        Role::create([
            'role_name' => 'patient',
            'role_id' => Str::uuid()
        ]);

        SuperAdmin::create([
            'id' => Str::uuid(),
            'name' => 'Super Admin',
            'phone' => '8181000621',
            'whatsapp' => '8181000621',
            'email' => 'ravi.arya009@gmail.com',
            'password' => Hash::make('ravi'),
            'gender' => 1
        ]);

        $this->call(QualificationSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SpecialitySeeder::class);
        $this->call(ClinicSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(FirstClinicDoctorsSeeder::class);
        // User::factory(25)->create()

    }
}
