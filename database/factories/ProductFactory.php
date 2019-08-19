<?php

use Faker\Generator as Faker;

$factory->define(CodeShopping\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'slug' => 'slug',
        'description' => $faker->colorName,
        'price' => $faker->randomFloat(10,0,8)
    ];
});
