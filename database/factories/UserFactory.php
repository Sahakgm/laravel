<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker, $data) {

    return [
        'name' => $faker->name,
        'role_id' => $data['role_id'],
        'email' => $faker->unique()->safeEmail,
        'password' => \Illuminate\Support\Facades\Hash::make('pass123'), // secret \str_random(10)\
        'remember_token' => str_random(10),
    ];
});
