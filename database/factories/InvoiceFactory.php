<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['B','P','V']);// Individual or Business
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'amount' => $this->faker->randomFloat(2, 50, 10000),
            'status' => $status,
            'billed_date' => $this->faker->dateTimeThisDecade(),
            'paid_date' => $status == 'P' ? $this->faker->dateTimeThisDecade() : null,
        ];
    }
}
