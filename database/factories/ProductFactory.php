<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'category_id' => Category::factory(), // <- ini yang penting
            'sku' => strtoupper($this->faker->bothify('SKU-####')),
            'brand' => $this->faker->company(),
            'price' => $this->faker->randomFloat(2, 10000, 500000),
            'stock' => $this->faker->numberBetween(1, 10),
            'image' => 'default.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
