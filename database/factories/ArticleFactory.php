<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'author' => $faker->name,
        'content' => $faker->text
    ];
});
