<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => Str::uuid(),
            'name' => 'admin',
        ]);

        Role::create([
            'id' => Str::uuid(),
            'name' => 'doctor',
        ]);

        Role::create([
            'id' => Str::uuid(),
            'name' => 'staff',
        ]);
    }
}
