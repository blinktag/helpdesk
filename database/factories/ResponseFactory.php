<?php

use Faker\Generator as Faker;

$factory->define(App\Response::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraphs(),
        'from'    => $faker->email,
    ];
});
