<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Speciality;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid,
            'name' => fake()->company,
            'slug' => fake()->slug,
            'phone' => fake()->unique()->numerify('98########'),
            'contact_person' => fake()->name,
            'contact_person_phone' => fake()->unique()->numerify('98########'),
            'address' => fake()->address,
            'area' => fake()->city,
            'speciality_id' => Speciality::inRandomOrder()->first()->id, // Fetching a random speciality
            'city_id' => City::inRandomOrder()->first()->id, // Fetching a random city
            'state_id' => State::inRandomOrder()->first()->id, // Fetching a random state
        ];
    }
}
