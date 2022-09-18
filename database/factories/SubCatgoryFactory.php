<?php

/** @var Factory $factory */

use App\Model;
use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\SubCategory::class, function (Faker $faker) {
    return [
        'slug' => $faker->slug,
        'name' => $faker->name,
        'categoryId' =>  IdHashingHelper::decode(\App\DbModels\Category::all()->random()->id)
    ];
});
