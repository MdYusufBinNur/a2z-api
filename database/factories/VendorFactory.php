<?php

/** @var Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\Vendor::class, function (Faker $faker) {
    return [
        'slug' => $faker->slug,
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'phone' => '01822270500',
        'website' => $faker->url,
        'additionalNote' => $faker->paragraph,
        'address' => $faker->address,
        'subCategoryIds' => [1,2,3],
        'type' => 'groceries',
        'tag' => $faker->randomElement(array('new','old', 'popular'))
    ];
});
