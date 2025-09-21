<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'order_code' => strtoupper('TWPOS-KS-' . Str::random(8)),
            'order_date' => $this->faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'order_amount' => $this->faker->numberBetween(10000, 500000),
            'order_change' => $this->faker->numberBetween(0, 10000),
            'order_status' => 1,
        ];
    }
}
