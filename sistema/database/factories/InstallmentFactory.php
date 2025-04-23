<?php

namespace Database\Factories;

use App\Models\Charge;
use App\Models\Installment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charge>
 */
class InstallmentFactory extends Factory
{
    protected $model = Installment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => 1,
            'charge_id' => Charge::factory(),
            'number' => 1,
            'value' => fake()->randomFloat(2, 10, 1000),
            'paid_value' => null,
            'due_date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'paid_date' => fake()->randomElement([null, fake()->dateTimeBetween('-1 year', '+1 year')]),
            'status' => fake()->randomElement(['pending', 'paid', 'overdue']),
            'download_link' => fake()->url(),
            'linha_digitavel' => fake()->randomNumber(),
        ];
    }
}
