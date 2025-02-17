<?php

namespace Database\Factories;

use App\Models\Qualification;
use App\Models\Speciality;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DoctorFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        $roleService = app(RoleService::class);

        $user = User::factory()->create([
            'role_id' => $roleService->fetchRoleIdByName('doctor'),
        ]);

        return [
            'user_id' => $user->id,
            'experience' => $this->faker->numberBetween(1, 20),
            'speciality_id' => Speciality::inRandomOrder()->first()->id,
            'qualification_id' => Qualification::inRandomOrder()->first()->id,
            'consultation_fee' => $this->faker->numberBetween(100, 1000),
            'bio' => $this->faker->paragraph,
        ];
    }
}
