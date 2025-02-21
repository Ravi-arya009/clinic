<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        SuperAdmin::firstOrCreate(
            ['email' => 'ravi.arya009@gmail.com'],
            [
                'id' => Str::uuid(),
                'name' => 'Ravi Arya',
                'phone' => '8181000621',
                'whatsapp' => '8181000621',
                'password' => Hash::make('ravi'),
                'gender' => 1,
            ]
        );
    }
}
