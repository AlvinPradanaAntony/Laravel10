<?php

namespace Tests\Feature\Dashboard;

use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderDetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_order_detail_and_stock_is_decremented()
    {

        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create([
            'name' => 'Jane Doe',
            'stock' => 10,
        ]);

        $orderDetail = [
            [
                'id' => $product->id,
                'quantity' => 5,
            ],
        ];

        $order->setOrderDetails($orderDetail);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 5,
        ]);
    }
}
