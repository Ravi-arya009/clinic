<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Clinic;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //for now, only creating doctors
        return [
            'id' => Str::uuid(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('##########'),
            'whatsapp' => fake()->unique()->numerify('##########'),
            'gender' => fake()->numberBetween(1, 2),
            'state_id' => State::inRandomOrder()->first()->id, // Fetching a random state
            'city_id' => City::inRandomOrder()->first()->id, // Fetching a random city
            'address' => fake()->address,
            'pincode' => fake()->numerify('######'),
            'role_id' => config('role.doctor'),
            'clinic_id' => Clinic::inRandomOrder()->first()->id,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
