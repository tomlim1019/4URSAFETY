<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(2,4)),
        'description' => $faker->text,
        'price' => rand(1000,10000),
        'tenure' => 6,
        'category' => rand(10),
        'image' => NULL,
    ];
});
