<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {

    return [
        'user_id' => App\User::pluck('id')->random(),
        'task_name'=>$faker->sentence,
        'body'=>$faker->paragraph,
    ];
});
