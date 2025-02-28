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
                    'clinic_id' => $clinic->id,
                    'password' => Hash::make('ravi'),
                ]);
            })->create();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
