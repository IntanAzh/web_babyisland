<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('user.dashboard');
    }

    /** @test */
    public function dashboard_displays_correct_order_statistics()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        // Buat order dengan status yang sesuai controller
        Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'process'
        ]);

        Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'sent'
        ]);

        Order::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'status' => 'complete'
        ]);

        $response = $this->get('/dashboard');

        $response->assertViewHas('stats', function ($stats) {
            return $stats['total_orders'] === 3 
                && $stats['active_orders'] === 2 
                && $stats['completed_orders'] === 1;
        });
    }

    /** @test */
    public function dashboard_shows_user_recent_orders()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        Order::factory()->count(5)->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $response = $this->get('/dashboard');

        $response->assertViewHas('recent_orders');
        $this->assertCount(5, $response->viewData('recent_orders'));
    }
}