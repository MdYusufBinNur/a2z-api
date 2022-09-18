<?php

/** @var Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\ProductStock::class, function (Faker $faker) {
    return [
        'productId' => 1,
        'createdByUserId' => 1,
        'price' => $faker->numberBetween(10, 10000),
        'oldPrice' => 0,
        'availableQuantity' => 100,
        'status' => 'available',
        'type' => 'unit',
    ];
});
