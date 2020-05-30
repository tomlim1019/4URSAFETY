<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'IC' => $faker->unique()->randomNumber,
        'username' => $faker->unique()->userName,
        'document' => $faker->url,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'name' => $faker->name,
        'age' => $faker->randomDigit,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'image' => $faker->url,
    ];
});
