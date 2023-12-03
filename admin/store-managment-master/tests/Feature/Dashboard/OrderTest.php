<?php

namespace Tests\Feature\Dashboard;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_make_a_delivery_to_order()
    {
        // $this->withExceptionHandling();
        $user = $this->login();
        $order = factory(Order::class)->create();

        $response = $this->put('/dashboard/orders/'. $order->id , [
            'added_price' => 10,
            'delivery_price' => 30,
            'delivery_man_id' => $user->id,
            'status' => Config::get('constants.order.deliverd'),
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'added_price' => 10,
            'delivery_price' => 30,
            'delivery_man_id' => $user->id,
            'status' => Config::get('constants.order.deliverd'),
        ]);

    }

}






