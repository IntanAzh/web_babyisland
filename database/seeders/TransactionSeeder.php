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
        // Menggunakan gambar produk yang sudah ada sebagai bukti pembayaran
        // karena folder transactions baru dibuat dan belum ada gambar di dalamnya
        $productImages = [
            'products/GHbsTMAsBhMtBiNGFmduuuZwUzJBmeMUAgEGkXYV.jpg',
            'products/GyHYUCV7gfYTVfPKc6CaCSb5ZkrddrdKAxXxjS9w.png',
            'products/JazU07i7NdEhz9dR8vSOcbfF8idMnGchbbHd9Jgx.jpg',
            'products/VabHHTI8cR8wMsoxyewuMp4lSmbQF91vCXCm8BBE.jpg'
        ];
        
        $orders = Order::all();

        foreach ($orders as $order) {
            Transaction::create([
                'order_id'       => $order->id,
                'bank_name'      => fake()->randomElement(['BCA', 'Mandiri', 'BRI', 'BNI']),
                'owner_name'     => fake()->name(),
                'account_number' => fake()->bankAccountNumber(),
                'invoice'        => 'INV-' . strtoupper(Str::random(10)),
                'status'         => fake()->randomElement(['pending', 'verified', 'rejected']),
                'image'          => $productImages[array_rand($productImages)], // Sementara menggunakan gambar produk
            ]);
        }
    }
}
