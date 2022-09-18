<?php

/** @var Factory $factory */

use App\Model;
use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\ContentModule::class, function (Faker $faker) {
    return [
        "createdByUserId"=> 1,
        "categoryId"=> IdHashingHelper::decode(\App\DbModels\Category::all()->random()->id),
        "subCategoryId"=> null,
        "type"=> "product",
        "title"=> $faker->randomElement(array('Bags & Lugages','Dry Foods', 'Sea Fish', 'Books & Stationery', 'Beauty And Bodycare', 'Bags & Lugages', 'Fresh Mutton meat')),
        "params"=> null
    ];
});
