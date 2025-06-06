<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public'); // untuk simulasikan file upload
    }

    /** @test */
    public function admin_can_create_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('product.jpg');

        $response = $this->actingAs($admin)->post(route('product.store'), [
            'name' => 'Stroller Bayi',
            'description' => 'Deskripsi produk',
            'price' => 100000,
            'sku' => 'SKU12345',
            'brand' => 'BabyBrand',
            'stock' => 5,
            'category_id' => $category->id,
            'image' => $image,
        ]);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', ['name' => 'Stroller Bayi']);
        Storage::disk('public')->assertExists('products/' . $image->hashName());
    }

    /** @test */
    public function admin_can_update_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($admin)->put(route('product.update', $product->id), [
            'name' => 'Updated Name',
            'description' => 'Updated Description',
            'price' => 200000,
            'sku' => $product->sku,
            'brand' => 'UpdatedBrand',
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', ['name' => 'Updated Name']);
    }

    /** @test */
    public function admin_can_delete_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($admin)->delete(route('product.destroy', $product->id));

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /** @test */
    public function normal_user_cannot_access_product_management()
    {
        $user = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($user)->get(route('product.index'));
        $response->assertStatus(403); // atau assertRedirect jika middleware redirect
    }
}
