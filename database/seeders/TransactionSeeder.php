<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            Transaction::create([
                'order_id'       => $order->id,
                'bank_name'      => fake()->randomElement(['BCA', 'Mandiri', 'BRI', 'BNI']),
                'owner_name'     => fake()->name(),
                'account_number' => fake()->bankAccountNumber(),
                'invoice'        => 'INV-' . strtoupper(Str::random(10)),
                'status'         => fake()->randomElement(['pending', 'verified', 'rejected']),
            ]);
        }
    }
}
