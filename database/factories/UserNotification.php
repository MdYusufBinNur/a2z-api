<?php

/** @var Factory $factory */

use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\DbModels\UserNotification::class, function (Faker $faker) {
    return [
        'toUserId' =>  1,
        'fromUserId' =>  IdHashingHelper::decode(App\DbModels\User::all()->random()->id),
        'userNotificationTypeId' =>  IdHashingHelper::decode(App\DbModels\UserNotificationType::all()->random()->id),
        'resourceId' => 1,
        'message' => $faker->sentence,
    ];
});
