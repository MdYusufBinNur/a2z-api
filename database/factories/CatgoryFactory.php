<?php

/** @var Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\Category::class, function (Faker $faker) {
    return [
        'slug' => $faker->slug,
        'name' => $faker->unique()->randomElement(array('Electronics','Groceries', 'Automobiles', 'Gadgets', 'Fish', 'Meet', 'Bakeries', 'Cloths', 'Furniture', 'Toys'))
    ];
});
