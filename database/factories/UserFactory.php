<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\DbModels\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => substr($faker->unique()->phoneNumber, 0,20),
        'isActive' => $faker->boolean,
        'password' => 'password', // password
        'locale' => 'yes', // password
        'remember_token' => Str::random(10),
    ];
});
