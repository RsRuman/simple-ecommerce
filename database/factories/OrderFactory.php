<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'grand_total'   => $this->faker->randomFloat(2, 100, 100000),
            'shipping_cost' => $this->faker->randomFloat(2, 50, 200),
            'discount'      => $this->faker->randomFloat(2, 0, 500),
            'user_id'       => random_int(1, 50),
        ];
    }
}
