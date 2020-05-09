<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articale;
use Faker\Generator as Faker;

$factory->define(Articale::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 40, $indexSize = 2),
        'body' => $faker->realText(200,2),
        'category_id' =>$faker->randomDigitNot(0),
        'created_by' => $faker->randomDigitNot(0)
    ];
});
