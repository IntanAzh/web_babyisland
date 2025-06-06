<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function user_can_upload_transaction_with_valid_data()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'pending'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/transactions', [
                'order_id' => $order->id,
                'bank_name' => 'Bank ABC',
                'owner_name' => 'Iftitah',
                'account_number' => '1234567890',
                'image' => UploadedFile::fake()->image('bukti.jpg'),
            ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Transaction created successfully']);

        $this->assertDatabaseHas('transactions', [
            'order_id' => $order->id,
            'bank_name' => 'Bank ABC',
            'owner_name' => 'Iftitah',
        ]);

        $fullUrl = $response->json('data.image');
        $relativePath = str_replace('/storage/', '', parse_url($fullUrl, PHP_URL_PATH));
        Storage::disk('public')->assertExists($relativePath);
    }

    /** @test */
    public function upload_fails_if_image_missing()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'pending'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/transactions', [
                'order_id' => $order->id,
                'bank_name' => 'Bank ABC',
                'owner_name' => 'Iftitah',
                'account_number' => '1234567890',
                // 'image' is intentionally omitted
            ]);

        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'The image field is required.']);
    }

    /** @test */
    public function upload_fails_if_order_does_not_belong_to_user()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $order = Order::factory()->create([
            'user_id' => $otherUser->id,
            'product_id' => $product->id,
            'status' => 'pending'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/transactions', [
                'order_id' => $order->id,
                'bank_name' => 'Bank ABC',
                'owner_name' => 'Iftitah',
                'account_number' => '1234567890',
                'image' => UploadedFile::fake()->image('bukti.jpg'),
            ]);

        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => 'Order not found']);
    }

    /** @test */
    public function upload_fails_if_transaction_already_exists_for_order()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'pending'
        ]);

        \App\Models\Transaction::factory()->create([
            'order_id' => $order->id,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/transactions', [
                'order_id' => $order->id,
                'bank_name' => 'Bank ABC',
                'owner_name' => 'Iftitah',
                'account_number' => '1234567890',
                'image' => UploadedFile::fake()->image('bukti.jpg'),
            ]);

        $response->dump();
        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'Transaction already exists for this order']);
    }
}
