<?php

/** @var Factory $factory */

use App\Model;
use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\DbModels\AdAndSlider::class, function (Faker $faker) {
    return [
        "vendorId" => IdHashingHelper::decode(App\DbModels\Vendor::all()->random()->id),
        "title" => $faker->title,
        "description" => $faker->paragraph,
        "tag"=>  $faker->randomElement(array('discount','flat', 'cashback')),
        "type"=> "ad",
        "isActive"=> true,
        "priority"=> $faker->randomElement(array('first','second', 'third')),
    ];
});
