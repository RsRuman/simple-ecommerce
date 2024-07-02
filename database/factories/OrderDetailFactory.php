<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'product_id' => random_int(1, 200),
            'order_id'   => random_int(1, 100),
            'unit_price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity'   => $this->faker->numberBetween(1, 10),
        ];
    }
}
