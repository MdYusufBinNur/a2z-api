<?php

/* @var $factory Factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\DbModels\UserProfile::class, function (Faker $faker) {
    return [
        'userId' => App\DbModels\User::all()->random()->id,
        'gender' => $faker->randomElement(array('male','female')),
        'occupation' => $faker->randomElement(array('businessmen','jobholder','doctor','engineer','teacher','banker','other')),
        'homeTown' => $faker->city,
        'birthDate' => $faker->dateTime
    ];
});
