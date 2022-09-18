<?php

/** @var Factory $factory */

use App\Model;
use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\Product::class, function (Faker $faker) {
    return [
        'slug' => $faker->slug,
        'name' => substr($faker->name(), 0, rand(10, 100)),
        'surname' => $faker->name,
        'brandId' => IdHashingHelper::decode(\App\DbModels\Brand::all()->random()->id),
        'categoryId' => IdHashingHelper::decode(\App\DbModels\Category::all()->random()->id),
        'subCategoryId' => IdHashingHelper::decode(\App\DbModels\SubCategory::all()->random()->id),
        'vendorId' => IdHashingHelper::decode(\App\DbModels\Vendor::all()->random()->id),
        'shortIntroduction' => $faker->text,
        'description' => $faker->paragraph,
    ];
});
