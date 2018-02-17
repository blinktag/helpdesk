<?php

use App\Department;
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
        'subject'       => $faker->sentence,
        'last_reply'    => $faker->dateTime(),
        'last_replier'  => $user->name,
        'user_id'       => $user->id,
        'department_id' => 1
    ];
});

$factory->define(App\Response::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'from'    => $faker->email
    ];
});

$factory->define(App\Pipe::class, function (Faker $faker) {
    return [
        'server'   => 'localhost',
        'username' => 'support@localhost'
    ];
});

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name'           => "Admin {$faker->name}",
        'email'          => $faker->unique()->safeEmail,
        'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Note::class, function (Faker $faker) {
    return [
        'content'  => $faker->word,
        'priority' => 'low'
    ];
});

$factory->define(App\Pipe::class, function (Faker $faker) {
    return [
        'server'   => $faker->domainName,
        'username' => $faker->email,
        'password' => $faker->password
    ];
});
