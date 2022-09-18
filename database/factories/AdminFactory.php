<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\DbModels\Admin;

$factory->define(App\DbModels\Admin::class, function (Faker $faker) {
    return [
        'userId' =>App\DbModels\User::all()->random()->id,
        'level' => $faker->randomElement([Admin::LEVEL_LIMITED, Admin::LEVEL_STANDARD, Admin::LEVEL_SUPER]),
        'userRoleId' => 1
    ];
});
