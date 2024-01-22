<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'house_no' => fake()->randomNumber(8),
            'category_id' => fake()->numberBetween($min = 1, $max = 4),
            'description' => fake()->realText($maxNbChars = 200, $indexSize = 2),
            'price' => fake()->numberBetween($min = 1000000, $max = 10000000)
        ];
    }
}
