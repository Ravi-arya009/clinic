<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'doctor', 'staff', 'receptionist'];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'id' => Str::uuid(),
                'name' => $role,
            ]);
        }
    }
}
