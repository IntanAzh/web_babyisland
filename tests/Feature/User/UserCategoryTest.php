<?php

namespace Tests\Feature\Category;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_all_categories_and_products_paginated()
    {
        Category::factory()->count(3)->create();
        Product::factory()->count(15)->create();

        $response = $this->get(route('category.index'));
        $response->assertStatus(200);
        $response->assertViewIs('category');
        $response->assertViewHasAll(['categories', 'products', 'activeCategory']);
    }

    /** @test */
    public function can_view_products_by_specific_category()
    {
        $kategoriA = Category::factory()->create(['slug' => 'kategori-a']);
        Product::factory()->count(5)->create(['category_id' => $kategoriA->id]);
        Category::factory()->count(2)->create();

        $response = $this->get(route('category.show', 'kategori-a'));
        $response->assertStatus(200);
        $response->assertViewIs('category');
        $response->assertViewHasAll(['categories', 'products', 'activeCategory']);
        $this->assertEquals('kategori-a', $response->viewData('activeCategory')->slug);
    }
}
