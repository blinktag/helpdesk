<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Ticket::class, function (Faker $faker) {

    $user = factory(App\User::class)->create();

    return [
        'subject'      => $faker->sentence,
        'last_reply'   => $faker->dateTime(),
        'last_replier' => $user->name,
        'user_id'      => $user->id
    ];
});


$factory->define(App\Response::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'from'    => $faker->email
    ];
});

