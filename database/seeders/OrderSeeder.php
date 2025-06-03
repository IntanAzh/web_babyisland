<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;


class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada user dan product terlebih dahulu
        $users = User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();
        
        // Kurir yang tersedia
        $couriers = ['JNE', 'J&T', 'SiCepat', 'Anteraja', 'Pos Indonesia'];

        // Kalau tidak ada data, jangan lanjut
        if (empty($users) || empty($products)) return;

        for ($i = 0; $i < 20; $i++) {
            $qty = rand(1, 5);
            $productId = $products[array_rand($products)];
            $product = Product::find($productId);
            $total = $product->price * $qty;

            $start = now()->subDays(rand(1, 30));
            $end = (clone $start)->addDays(7);

            Order::create([
                'user_id'     => $users[array_rand($users)],
                'product_id'  => $productId,
                'qty'         => $qty,
                'start_date' => $start->format('Y-m-d'),
                'end_date'    => $end->format('Y-m-d'),
                'total_price' => $total,
                'address'     => fake()->address(),
                'notes'       => fake()->optional(0.7)->sentence(),
                'status'      => fake()->randomElement(['pending', 'process', 'sent', 'complete', 'cancel', 'delivered']),
                'courier'     => $couriers[array_rand($couriers)],
            ]);
        }
    }
}
