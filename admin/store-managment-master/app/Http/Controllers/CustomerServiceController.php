<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CustomerServiceStoreRequest;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(100);

        return inertia()->render('Dashboard/customer-services/index', [
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
        $products = Product::all();
        $categories = Category::with('subcategories')->get();
        $products->map(function ($product) {
            $product['image'] = $product->image;
            $product['selected'] = false;
            $product['quantity'] = 0;
            return $product;
        });

        return inertia()->render('Dashboard/customer-services/create', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerServiceStoreRequest $request)
    {
        $request->validated();

        $order = Order::create([
            'customer_phone' => $request->customer_phone,
            'customer_alt_phone' => $request->customer_alt_phone,
            'customer_address' => $request->customer_address,
            'discount' => $request->discount,
            'user_id' => auth()->id(),
        ]);

        $order->setOrderDetails($request->orderDetails);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم أضافة الطلب'
        ]);

        return redirect()->route('customer.services.index');

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
    public function update(Request $request, Order $order)
    {
        //
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
