<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Perlengkapan Perjalanan',
                'slug' => Str::slug('Perlengkapan Perjalanan'),
                'description' => 'Berbagai perlengkapan perjalanan untuk kebutuhan bayi dan anak',
                'image' => 'categories/CNe6HWCasjasFQ6nO9O1QQKyi8XeLzpUIkGTzHWW.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mainan & Edukasi',
                'slug' => Str::slug('Mainan & Edukasi'),
                'description' => 'Mainan dan perlengkapan edukasi untuk tumbuh kembang anak',
                'image' => 'categories/GiDV00o9UDAehW8BQupeYGLq1CA5GmjIdqoB0z1g.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tidur & Kenyamanan',
                'slug' => Str::slug('Tidur & Kenyamanan'),
                'description' => 'Produk-produk untuk kenyamanan dan tidur bayi',
                'image' => 'categories/ZndwEV02XRPVw52cdqQXKRQUQtPqCV4qLEMXK0eh.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}