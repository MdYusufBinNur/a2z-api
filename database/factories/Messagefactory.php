<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;

$factory->define(App\DbModels\Message::class, function (Faker $faker) {
    return [
        'fromUserId' =>  IdHashingHelper::decode(App\DbModels\User::all()->random()->id),
        'toUserId' =>  IdHashingHelper::decode(App\DbModels\User::all()->random()->id),
        'subject' => $faker->title,
        'isGroupMessage' => $faker->boolean,
        'group' => $faker->title,
        'groupNames' => $faker->name,
        'emailNotification' => $faker->boolean,
        'smsNotification' => $faker->boolean,
        'voiceNotification' => $faker->boolean,
    ];
});
