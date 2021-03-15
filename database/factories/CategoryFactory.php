<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Api\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    return [
        'name' => $faker->realText(rand(30, 40)),
        'level' => 1,
    ];

});
