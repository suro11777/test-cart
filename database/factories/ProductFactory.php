<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Api\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $title = $faker->realText(rand(40, 50));
    return [
        'category_id' => rand(8, 18),

        'title' => $title,
        'description' => $faker->realText(rand(400, 500)),
        'slug' => create_slug($title),
        'price' => rand(1000, 2000),
    ];
});
