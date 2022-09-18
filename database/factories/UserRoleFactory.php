<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\UserRole::class, function (Faker $faker) {
    return [
        'roleId'   => App\DbModels\Role::all()->random()->id,
        'userId'   => App\DbModels\User::all()->random()->id,
//        'propertyId'   => App\DbModels\Property::all()->random()->id,
    ];
});
