<?php

use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'subject'    => $faker->sentence,
        'last_reply' => $faker->dateTime()
    ];
});
