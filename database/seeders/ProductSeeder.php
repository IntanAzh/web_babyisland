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
     */    public function run(): void
    {
        // Gambar produk yang tersedia di storage
        $productImages = [
            'products/GHbsTMAsBhMtBiNGFmduuuZwUzJBmeMUAgEGkXYV.jpg',
            'products/GyHYUCV7gfYTVfPKc6CaCSb5ZkrddrdKAxXxjS9w.png',
            'products/JazU07i7NdEhz9dR8vSOcbfF8idMnGchbbHd9Jgx.jpg',
            'products/VabHHTI8cR8wMsoxyewuMp4lSmbQF91vCXCm8BBE.jpg'
        ];
        
        $productData = [
            // Category 1: Perlengkapan Perjalanan
            [
                'name' => 'Car Seat Bayi Premium',
                'description' => 'Car seat bayi dengan fitur keamanan premium, cocok untuk perjalanan dengan bayi usia 0-24 bulan.',
                'category_id' => 1,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'BabyLux',
                'price' => 1250000,
                'stock' => 15,
                'image' => $productImages[0],
            ],
            [
                'name' => 'Stroller Travel Kompak',
                'description' => 'Stroller yang dapat dilipat kecil, cocok untuk bepergian dan mudah dibawa-bawa.',
                'category_id' => 1,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'BabyLux',
                'price' => 1850000,
                'stock' => 10,
                'image' => $productImages[1],
            ],
            [
                'name' => 'Tas Perlengkapan Bayi',
                'description' => 'Tas luas dengan banyak kompartemen untuk menyimpan kebutuhan bayi saat bepergian.',
                'category_id' => 1,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'BabyLux',
                'price' => 499000,
                'stock' => 25,
                'image' => $productImages[2],
            ],
            [
                'name' => 'Gendongan Bayi Ergonomis',
                'description' => 'Gendongan yang dirancang khusus untuk kenyamanan bayi dan orangtua, mengurangi ketegangan punggung.',
                'category_id' => 1,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'BabyLux',
                'price' => 350000,
                'stock' => 30,
                'image' => $productImages[3],
            ],
            
            // Category 2: Mainan & Edukasi
            [
                'name' => 'Mainan Puzzle Edukasi',
                'description' => 'Puzzle kayu dengan bentuk hewan dan angka untuk stimulasi motorik halus dan kognitif.',
                'category_id' => 2,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'ToysRUs',
                'price' => 125000,
                'stock' => 40,
                'image' => $productImages[0],
            ],
            [
                'name' => 'Buku Sensori Bayi',
                'description' => 'Buku kain dengan berbagai tekstur untuk stimulasi indera peraba bayi.',
                'category_id' => 2,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'ToysRUs',
                'price' => 89000,
                'stock' => 35,
                'image' => $productImages[1],
            ],
            [
                'name' => 'Balok Susun Warna-Warni',
                'description' => 'Set balok kayu dengan berbagai warna dan bentuk untuk melatih kreativitas anak.',
                'category_id' => 2,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'ToysRUs',
                'price' => 159000,
                'stock' => 25,
                'image' => $productImages[2],
            ],
            [
                'name' => 'Piano Mini untuk Bayi',
                'description' => 'Piano dengan tombol warna-warni dan suara hewan untuk pengenalan musik sejak dini.',
                'category_id' => 2,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'ToysRUs',
                'price' => 235000,
                'stock' => 20,
                'image' => $productImages[3],
            ],
            
            // Category 3: Tidur & Kenyamanan
            [
                'name' => 'Bantal Latex Bayi Premium',
                'description' => 'Bantal lembut yang mendukung posisi kepala bayi dengan sempurna, anti alergi.',
                'category_id' => 3,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'Sleepy',
                'price' => 175000,
                'stock' => 30,
                'image' => $productImages[0],
            ],
            [
                'name' => 'Selimut Bayi Berbahan Katun',
                'description' => 'Selimut lembut berbahan 100% katun organik, aman untuk kulit sensitif bayi.',
                'category_id' => 3,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'Sleepy',
                'price' => 120000,
                'stock' => 40,
                'image' => $productImages[1],
            ],
            [
                'name' => 'Box Bayi Multifungsi',
                'description' => 'Tempat tidur bayi yang dapat diubah menjadi meja ganti popok, praktis dan hemat tempat.',
                'category_id' => 3,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'IKEA',
                'price' => 1950000,
                'stock' => 8,
                'image' => $productImages[2],
            ],
            [
                'name' => 'Kasur Bayi Anti Tungau',
                'description' => 'Kasur khusus dengan teknologi anti tungau dan bakteri, memberikan tidur nyenyak untuk bayi.',
                'category_id' => 3,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand' => 'Sleepy',
                'price' => 850000,
                'stock' => 12,
                'image' => $productImages[3],
            ],
        ];

        foreach ($productData as $product) {
            Product::create(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
