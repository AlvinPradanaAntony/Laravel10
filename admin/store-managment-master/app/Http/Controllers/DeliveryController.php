<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::where('delivery_man_id', auth()->id())->latest()->paginate(100);

        return inertia()->render('Dashboard/deliveries/index', [
            'orders' => $orders,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        $orderDetails->map(function ($orderDetail) {
            $orderDetail['image'] = $orderDetail->product->image;
            return $orderDetail;
        });

        return inertia()->render('Dashboard/deliveries/show', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

}
