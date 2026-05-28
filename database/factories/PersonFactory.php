<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'first_name' => fake()->firstName(),

            'last_name' => fake()->lastName(),

            'address' => fake()->address(),

            'gender' => fake()->randomElement(['male', 'female']),

            'date_of_birth' => fake()->date('Y-m-d', '2005-01-01'),

            'phone' => fake()->phoneNumber(),
        ];
    }
}
