<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {

    return [
        'task_id' => App\Task::pluck('id')->random(),
        'comment' => $faker->paragraph,
    ];
});
