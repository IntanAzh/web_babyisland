<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'qty' => $this->faker->numberBetween(1, 3),
            'start_date' => now(),
            'end_date' => now()->addDays($this->faker->numberBetween(1, 7)),
            'total_price' => $this->faker->randomFloat(2, 50000, 500000),
            'address' => $this->faker->address(),
            'notes' => $this->faker->sentence(),
            'status' => 'complete', // atau pending, confirmed, process, dst.
            'courier' => 'JNE',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
