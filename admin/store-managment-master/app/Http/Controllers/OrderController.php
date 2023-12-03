<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Subcategory;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::with(['user', 'deliveryMan'])->latest()->paginate(100);

        return inertia()->render('Dashboard/orders/index', [
            'orders' => $orders,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $users = User::permission('delivery-man')->get();

        $orderDetails->map(function ($orderDetail) {
            $orderDetail['image'] = $orderDetail->product->image;
            return $orderDetail;
        });
        return inertia()->render('Dashboard/orders/show', [
            'order' => $order,
            'users' => $users,
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $request->validated();

        $order->update([
            'delivery_price' => $request->delivery_price,
            'delivery_man_id' => $request->delivery_man_id,
            'status' => $request->status,
            'added_price' => $request->added_price,
            'total_price' => $order->setOrderTotalPrice($request->added_price, $request->delivery_price),
        ]);

        if ($order->isDelivered()) {
            $order->setOrderUserBalance();
        }
        if ($order->isReturned()) {
            $order->returnOrderDetailsQuantityToStock();
        }

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تمت العملية بنجاح'
        ]);

        return redirect()->route('orders.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}


