<?php

namespace Tests\Unit;

use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;

class OrderTest extends TestCase
{
    use RefreshDatabase;
//delivery-man
    /** @test */
    public function createPermission($permission)
    {
        $permission = factory(Permission::class)->create([
            'name' => $permission,
        ]);

        $this->login();

        $response = $this->post('/dashboard/users', [
            'name' => 'Jone Doe',
            'username' => 'test',
            'phone' => '0123456789',
            'alt_phone' => '9876543210',
            'address' => 'Arkawet',
            'balance' => 50,
            'password' => 'password',
            'password_confirmation' => 'password',
            'permission' => $permission->id,
        ]);

    }

    /** @test */
    public function set_order_total_price()
    {
        $order = new Order();

        $totalPrice = $order->setOrderTotalPrice(50, 30);

        $this->assertEquals(80, $totalPrice);

    }

    /**  */
    public function set_user_balance()
    {
        $user = factory(User::class)->create([
            'balance' => 0
        ]);
        $this->login($user);

        $order = factory(Order::class)->states('deliverd')->create([
            'user_id' => $user->id,
        ]);
        $orderDetail = factory(OrderDetail::class)->create([
            'order_id' => $order->id,
        ]);

        $orderDetail->order->setUserBalance();
        // dd($orderDetail->order->id);
        dd($user);

    }

    /** @test */
    public function return_order_details_quantity_to_stock()
    {

        $product = factory(Product::class)->create([
            'stock' => 5,
        ]);
        $orderDetail = factory(OrderDetail::class)->create([
            'product_id' => $product->id,
            'quantity' => 5,
        ]);

        $orderDetail->order->returnOrderDetailsQuantityToStock();

    }

}





