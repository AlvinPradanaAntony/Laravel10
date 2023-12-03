<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_phone' => $faker->phoneNumber,
        'customer_alt_phone' => $faker->phoneNumber,
        'customer_address' => $faker->address,
        'delivery_price' => $faker->numberBetween($min = 0, $max = 100),
        'added_price' => $faker->numberBetween($min = 0, $max = 100),
        'discount' => $faker->numberBetween($min = 0, $max = 100),
        'total_price' => $faker->numberBetween($min = 0, $max = 100),
        'delivery_man_id' => function(){
            return factory(User::class)->create()->id;
        },
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
    ];
});

$factory->state(App\Order::class, 'deliverd', function($faker){
    return[
        'status' => Config::get('constants.order.deliverd'),
    ];
});

$factory->state(App\Order::class, 'returned', function($faker){
    return[
        'status' => Config::get('constants.order.returned'),
    ];
});
