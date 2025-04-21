<?php

namespace Database\Factories;

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
            'number',
            'value',
            'paid_value',
            'due_date',
            'paid_date',
            'status',
            'download_link',
            'linha_digitavel',
        ];
    }
}
