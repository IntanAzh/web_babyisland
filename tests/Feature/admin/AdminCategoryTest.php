<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function admin_can_create_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $image = UploadedFile::fake()->image('category.jpg');

        $response = $this->actingAs($admin)->post(route('kategori.store'), [
            'name' => 'Perlengkapan Bayi',
            'slug' => 'perlengkapan-bayi',
            'description' => 'Kategori perlengkapan bayi',
            'image' => $image
        ]);

        $response->assertRedirect(route('admin.kategori.index'));
        $this->assertDatabaseHas('categories', ['name' => 'Perlengkapan Bayi']);
        Storage::disk('public')->assertExists('categories/' . $image->hashName());
    }

    /** @test */
    public function admin_can_update_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->put(route('kategori.update', $category->id), [
            'name' => 'Updated Name',
            'slug' => 'updated-slug',
            'description' => 'Updated description',
        ]);

        $response->assertRedirect(route('admin.kategori.index'));
        $this->assertDatabaseHas('categories', ['name' => 'Updated Name']);
    }

    /** @test */
    public function admin_can_delete_category_without_products()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->delete(route('kategori.destroy', $category->id));

        $response->assertRedirect(route('admin.kategori.index'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /** @test */
    public function admin_cannot_delete_category_with_products()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($admin)->delete(route('kategori.destroy', $category->id));

        $response->assertRedirect(); // tetap redirect ke halaman sebelumnya
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    /** @test */
    public function normal_user_cannot_access_category_management()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('admin.kategori.index'));
        $response->assertStatus(403); // jika middleware admin abort(403)
    }
}
