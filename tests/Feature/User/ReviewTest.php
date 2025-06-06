<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Disable FK checks if needed
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    protected function tearDown(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        parent::tearDown();
    }

    /** @test */
    public function user_can_submit_product_review()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $order = Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'complete',
        ]);

        $response = $this->postJson('/api/reviews', [
            'product_id' => $product->id,
            'rating' => 5,
            'comment' => 'Produk sangat bagus!'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 5,
            'comment' => 'Produk sangat bagus!'
        ]);
    }

    /** @test */
    public function user_cannot_review_product_they_have_not_ordered()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->postJson('/api/reviews', [
            'product_id' => $product->id,
            'rating' => 4,
            'comment' => 'Nice product!'
        ]);

        $response->assertStatus(403);
        $response->assertJsonFragment(['message' => 'You can only review products you have purchased/rented']);
    }

    /** @test */
    public function user_cannot_review_the_same_product_twice()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $order = Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'complete',
        ]);

        // First review
        $this->postJson('/api/reviews', [
            'product_id' => $product->id,
            'rating' => 4,
            'comment' => 'Great!'
        ]);

        // Second review should fail
        $response = $this->postJson('/api/reviews', [
            'product_id' => $product->id,
            'rating' => 3,
            'comment' => 'Changed my mind'
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'You have already reviewed this product']);
    }

    /** @test */
    public function test_review_fails_if_required_fields_missing()
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/reviews', []); // request kosong

        $response->assertStatus(422);
        $errors = $response->json('data');
        $this->assertIsArray($errors);
        $this->assertArrayHasKey('rating', $errors);
        $this->assertArrayHasKey('comment', $errors);

    }
}
