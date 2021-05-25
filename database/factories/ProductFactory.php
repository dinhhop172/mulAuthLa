<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'price' => $faker->randomDigit,
        'image' => $faker->imageUrl($width = 200, $height = 200),
        'desc' => $faker->paragraph,
    ];
});
