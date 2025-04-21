<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charge>
 */
class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->title(),
            'client_id' => fake()->numberBetween(1, 500),
            'value' => fake()->randomFloat(2, 1, 1000),
            'due_date' => fake()->date(),
            'status' => fake()->randomElement(['paid', 'unpaid']),
            'gateway' => fake()->randomElement(['banco_brasil', 'santader', 'manual']),
        ];
    }
}
