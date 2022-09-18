<?php

/** @var Factory $factory */

use App\Model;
use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\Brand::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'slug' => $faker->slug,
        'tag' => $faker->randomElement(array('new','old', 'popular')),
        'categoryId' =>  IdHashingHelper::decode(\App\DbModels\Category::all()->random()->id),
        'ownerName' => $faker->name,
        'address' => $faker->address,
    ];
});
