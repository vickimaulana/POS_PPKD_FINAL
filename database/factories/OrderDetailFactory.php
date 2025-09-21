<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $qty = $this->faker->numberBetween(1, 5);
        $order_price = $this->faker->numberBetween(10000, 500000);
        $order_subtotal = $order_price * $qty;

        return [
            'order_id' => $this->faker->numberBetween(1, 15),
            'product_id' => $this->faker->numberBetween(1, 50),
            'qty' => $qty,
            'order_price' => $order_price,
            'order_subtotal' => $order_subtotal,
        ];
    }
}
