<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'category_id'=>'2',
        'manufacture_id'=>'1',
        'name'=>$faker->name,
        'slug'=>str_slug($faker->sentence($nbWords = 6, $variableNbWords = true)),
        'description'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'content'=>$faker->text($maxNbChars = 500),
        'origin_price'=>$faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'sale_price'=>$faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
    ];
});
