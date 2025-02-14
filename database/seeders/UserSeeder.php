<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'id' => Str::uuid(),
            'name' => 'Ravi Arya',
            'phone' => '8181000621',
            'whatsapp' => '8181000621',
            'email' => 'ravi.arya009@gmail.com',
            'password' => Hash::make('ravi'),
            'gender' => 1,
            'role_id' => config('role.admin'),
            'clinic_id' => Clinic::inRandomOrder()->first()->id
        ]);
    }
}
