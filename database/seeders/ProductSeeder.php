<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            $name = "Product $i";
            Product::create([
                'name' => $name,
                'description' => "Deskripsi untuk $name.",
                'category_id' => rand(1, 3),
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => ['IKEA', 'Sleepy', 'BabyLux', 'ToysRUs'][rand(0, 3)],
                'price' => rand(10000, 500000),
                'stock' => rand(0, 100),
                'image' => null,
            ]);
        }
    }
}
