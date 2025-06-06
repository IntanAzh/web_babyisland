<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminOrderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Buat admin
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);

        // Buat Product & Order dummy
        $product = Product::factory()->create(['stock' => 10, 'price' => 10000]);
        $this->order = Order::factory()->create([
            'product_id' => $product->id,
            'user_id' => $this->admin->id,
            'qty' => 2,
            'start_date' => now(),
            'end_date' => now()->addDays(1),
            'total_price' => 20000,
            'address' => 'Alamat test',
            'status' => 'pending',
            'courier' => 'JNE',
        ]);
        $this->transaction = Transaction::factory()->create([
            'order_id' => $this->order->id,
            'status' => 'pending',
            'invoice' => 'INV-TEST',
        ]);
    }

    /** @test */
    public function admin_can_view_all_orders()
    {
        $response = $this->get(route('order.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.order.index');
        $response->assertViewHas('orders');
    }

    /** @test */
    public function admin_can_update_order_status_to_cancel_and_stock_returns_to_product()
    {
        $productBefore = $this->order->product->stock;
        $response = $this->put(route('admin.order.update-status', $this->order), [
            'status' => 'cancel',
        ]);


        $response->assertRedirect();
        $this->assertEquals('cancel', $this->order->fresh()->status);

        // Stok produk mesti bertambah sebanyak qty
        $this->assertEquals(
            $productBefore + $this->order->qty,
            $this->order->product->fresh()->stock
        );
    }
}
