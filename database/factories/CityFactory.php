<?php

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
        'country' => 'GR'
    ];
});
