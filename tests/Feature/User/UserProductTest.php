<?php

namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    /** @test */
    public function can_view_product_detail_with_rental_prices()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 10000
        ]);

        $response = $this->getJson('/api/products/' . $product->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'sku',
                'brand',
                'price',
                'stock',
                'image',
                'category' => [
                    'id',
                    'name'
                ]
            ]
        ]);
    }


    /** @test */
    public function can_view_catalog_and_filter_by_search_and_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        Product::factory()->create([
            'name' => 'Produk ABC',
            'description' => 'Deskripsi A',
            'category_id' => $category1->id,
        ]);

        Product::factory()->create([
            'name' => 'Produk XYZ',
            'description' => 'Deskripsi B',
            'category_id' => $category2->id,
        ]);

        // Filter by search
        $responseSearch = $this->getJson('/api/products?search=ABC');

        $responseSearch->assertStatus(200);
        $responseSearch->assertJsonFragment(['name' => 'Produk ABC']);

        // Filter by category
        $responseCategory = $this->getJson('/api/products?category_id=' . $category2->id);

        $responseCategory->assertStatus(200);
        $responseCategory->assertJsonFragment(['name' => 'Produk XYZ']);
    }
}