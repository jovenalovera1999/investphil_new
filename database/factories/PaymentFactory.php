<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_method_id' => fake()->numberBetween($min = 1, $max = 2),
            'invoices' => fake()->randomNumber(8),
            'client_house_id' => fake()->numberBetween($min = 1, $max = 300),
            'downpayment_id' => fake()->numberBetween($min = 1, $max = 3),
            'monthly_paid' => fake()->randomNumber(5)
        ];
    }
}
