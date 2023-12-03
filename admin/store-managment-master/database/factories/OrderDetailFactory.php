<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\OrderDetail;
use App\Product;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => function(){
            return factory(Order::class)->create()->id;
        },
        'product_id' => function(){
            return factory(Product::class)->create()->id;
        },
        'quantity' => $faker->numberBetween($min = 1, $max = 100),
    ];
});
