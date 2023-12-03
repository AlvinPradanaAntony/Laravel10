<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'admin_commission' => $faker->numberBetween($min = 0, $max = 100),
        'marketer_commission' => $faker->numberBetween($min = 0, $max = 100),
        'package_price' => $faker->numberBetween($min = 0, $max = 100),
        'weight_avaliable' => true,
        'gram_price' => $faker->numberBetween($min = 0, $max = 100),
    ];
});
