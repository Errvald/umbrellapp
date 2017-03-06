<?php

$factory->define(App\Weather::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'icon' => $faker->shuffle('0h2k')
    ];
});