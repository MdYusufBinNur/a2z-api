<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Services\Helpers\IdHashingHelper;
use Faker\Generator as Faker;

$factory->define(App\DbModels\MessageUser::class, function (Faker $faker) {
    return [
        'messageId' =>  IdHashingHelper::decode(App\DbModels\Message::all()->random()->id),
        'userId' =>  IdHashingHelper::decode(App\DbModels\User::all()->random()->id),
        'folder' => $faker->randomElement(array('inbox','sent')),
        'isRead' => $faker->boolean,
    ];
});
