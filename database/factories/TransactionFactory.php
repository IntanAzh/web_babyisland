<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'bank_name' => $this->faker->company(),
            'owner_name' => $this->faker->name(),
            'account_number' => $this->faker->numerify('123456####'),
            'invoice' => 'INV-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'status' => 'pending',
            'image' => 'transactions/fake.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
