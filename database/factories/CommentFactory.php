<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'message' => $faker->words(3, true),
        'article_id' => $faker->unique()->randomDigit
    ];
});
