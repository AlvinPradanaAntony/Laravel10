<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use App\Subcategory;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'weight' => $faker->numberBetween($min = 0, $max = 100),
        'added_value' => $faker->numberBetween($min = 0, $max = 100),
        'deducted_value' => $faker->numberBetween($min = 0, $max = 100),
        'price' => $faker->numberBetween($min = 0, $max = 100),
        'total_price' => $faker->numberBetween($min = 0, $max = 100),
        'code' => $faker->numberBetween($min = 0, $max = 100),
        'stock' => $faker->numberBetween($min = 0, $max = 100),
        'category_id' => function(){
            return factory(Category::class)->create()->id;
        },
        'subcategory_id' => function(){
            return factory(Subcategory::class)->create()->id;
        },
    ];
});
