<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name'              => $faker->name,
        'username'          => str_random(25),
        'email'             => $faker->email,
        'password'          => str_random(10),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(App\StatusUpdate::class, function ($faker) {
    return [
        'message'   => $faker->paragraph,
        'user_id'   => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});