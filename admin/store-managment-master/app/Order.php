<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;

class Order extends Model
{
    protected $guarded = [];
    // protected $with = ['orderDetails'];

    public function setOrderDetails($orderDetails)
    {
        foreach ($orderDetails as $orderDetail) {

            $orderDetail = OrderDetail::create([
                'product_id' => $orderDetail['id'],
                'order_id' => $this->id,
                'quantity' => $orderDetail['quantity'],
            ]);
            $orderDetail->product->decrement('stock', $orderDetail->quantity);
            $this->total_price += $orderDetail->product->total_price * $orderDetail->quantity;

        }

        if (!empty($this->discount)) {
            $this->total_price -= $this->discount;
        }

        $this->save();
    }

    public function setOrderTotalPrice($addedPrice, $deliveryPrice)
    {
        return $this->total_price += $addedPrice + $deliveryPrice;
    }

    public function setOrderUserBalance()
    {

        $user = User::findOrFail($this->user_id);

        foreach ($this->orderDetails as $orderDetail) {

            if ($user->permission == 'admin') {
                $user->balance += $orderDetail->product->category->admin_commission * $orderDetail->quantity;
            }
            if ($user->permission == 'marketer') {
                $user->balance += $orderDetail->product->category->marketer_commission * $orderDetail->quantity;
            }

        }

        $user->save();

    }

    public function returnOrderDetailsQuantityToStock()
    {

        foreach ($this->orderDetails as $orderDetail) {

            $orderDetail->product->stock += $orderDetail->quantity;

        }

    }

    public function isDelivered() {

        if ($this->status == Config::get('constants.order.deliverd')) {
            return true;
        }
        return false;

    }

    public function isReturned() {

        if ($this->status == Config::get('constants.order.returned')) {
            return true;
        }
        return false;

    }

    public function getCreatedAtAttribute($value){

        return Carbon::parse($value)->format('M d Y');

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryMan()
    {
        return $this->belongsTo('App\User', 'delivery_man_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


}
