<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class OrderCheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_order_successfully()
    {
        $user = User::factory()->create([
            'role' => 'user',
            'password' => bcrypt('password')
        ]);

        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'stock' => 10,
            'price' => 50000,
            'category_id' => $category->id
        ]);

        $payload = [
            'product_id' => $product->id,
            'qty' => 2,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(3)->format('Y-m-d'),
            'address' => 'Jl. Testing No. 123',
            'courier' => 'JNE',
            'notes' => 'Tolong dikirim pagi'
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/orders', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Order created successfully',
            ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'qty' => 2
        ]);
    }


    /** @test */
    public function user_cannot_order_if_stock_insufficient()
    {
        $user = User::factory()->create(['role' => 'user']);

        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'stock' => 1,
            'category_id' => $category->id
        ]);

        $payload = [
            'product_id' => $product->id,
            'qty' => 5,
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(2)->format('Y-m-d'),
            'address' => 'Jl. Testing',
            'courier' => 'JNE'
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/orders', $payload);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Product out of stock or insufficient quantity'
            ]);
    }


    /** @test */
    public function user_cannot_order_with_invalid_dates()
    {
        $user = User::factory()->create(['role' => 'user']);

        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'stock' => 5,
            'category_id' => $category->id
        ]);

        $payload = [
            'product_id' => $product->id,
            'qty' => 1,
            'start_date' => now()->addDays(3)->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'), // end_date < start_date
            'address' => 'Jl. Salah Tanggal',
            'courier' => 'JNE'
        ];

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/orders', $payload);

        $response->assertStatus(422);
        $this->assertStringContainsString('The end date field must be a date after start date.', $response->json('message'));
    }
}
