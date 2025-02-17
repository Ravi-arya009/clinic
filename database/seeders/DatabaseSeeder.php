<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //creating super admin for testin purposes
        SuperAdmin::create([
            'id' => Str::uuid(),
            'name' => 'Ravi Arya',
            'phone' => '8181000621',
            'whatsapp' => '8181000621',
            'email' => 'ravi.arya009@gmail.com',
            'password' => Hash::make('ravi'),
            'gender' => 1,
        ]);

        $this->call(RoleSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SpecialitySeeder::class);
        $this->call(QualificationSeeder::class);
        $this->call(ClinicSeeder::class);
        $this->call(MedicineMasterSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(FirstClinicDoctorsSeeder::class);
    }
}
