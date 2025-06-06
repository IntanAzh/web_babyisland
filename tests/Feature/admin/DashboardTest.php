<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_access_dashboard()
{
    $admin = User::factory()->create([
        'username' => 'admin1',
        'email' => 'admin@example.com',
        'phonenumber' => '08123456789',
        'role' => 'admin',
        'password' => bcrypt('password123'),
    ]);

    $user = User::factory()->create([
        'username' => 'iftitah',
        'email' => 'iftitah@example.com',
        'phonenumber' => '08123456789',
        'role' => 'user',
    ]);

    // Buat kategori terlebih dahulu
    $category = \App\Models\Category::factory()->create();

    // Produk butuh kategori
    $product = \App\Models\Product::factory()->create([
        'category_id' => $category->id
    ]);

    \App\Models\Order::factory()->create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'qty' => 1,
        'start_date' => now(),
        'end_date' => now()->addDays(3),
        'total_price' => 100000,
        'status' => 'complete',
        'address' => 'Jalan Testing No.1'
    ]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');

    $response->assertStatus(200);
    $response->assertViewHas('info');
}



    /** @test */
    public function normal_user_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create([
            'username' => 'iftitah',
            'email' => 'iftitah@example.com',
            'phonenumber' => '08123456789',
            'role' => 'user',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        // Cek apakah diarahkan ke halaman lain (default Laravel bisa redirect ke /)
        $response->assertStatus(403); // atau bisa juga assertRedirect() jika middleware redirect
    }

    /** @test */
    public function guest_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }
}
