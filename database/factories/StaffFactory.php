<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;

use Illuminate\Support\Facades\Hash;

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => 'admin@test.com',
        'password' => Hash::make('admin123'), // password
        'name' => 'Admin',
        'id_no' => 1234567890,
        'birthdate' => '2020-02-02',
        'gender' => 'Others',
        'status' => 'Approved',
        'document' => NULL,
    ];
});
