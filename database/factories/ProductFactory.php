<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6),
        'description' => $faker->paragraph(3),
        'category' => 'Personal',
        'image' => $faker->url,
        'price' => $faker->randomFloat(0,0,100000),
        'tenure' => $faker->randomDigit
    ];
});
