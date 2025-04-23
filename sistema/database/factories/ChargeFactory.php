<?php

namespace Database\Factories;

use App\Models\Charge;
use App\Models\Installment;
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
            'description' => fake()->sentence(),
            'client_id' => fake()->numberBetween(1, 500),
            'value' => fake()->randomFloat(2, 1, 1000),
            'due_date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'status' => fake()->randomElement(['paid', 'unpaid']),
            'gateway' => fake()->randomElement(['banco_brasil', 'santader', 'manual']),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Charge $charge) {
            $installmentsCount = rand(1, 12);

            $installmentNumbers = collect(range(1, $installmentsCount));

            Installment::factory()
                ->count($installmentsCount)
                ->sequence(fn ($sequence) => [
                    'number' => $installmentNumbers[$sequence->index],
                    'charge_id' => $charge->id,
                    'tenant_id' => $charge->tenant_id,
                ])
                ->create();
        });
    }
}
