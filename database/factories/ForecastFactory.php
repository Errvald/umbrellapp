<?php

$factory->define(App\Forecast::class, function (Faker\Generator $faker) {
    return [
        'day'   => $faker->date($format = 'Y-m-d', $max = 'now'),
        'c_min' => $faker->numberBetween($min = -5, $max = 40),
        'c_max' => $faker->numberBetween($min = -5, $max = 40),
        'f_min' => $faker->numberBetween($min = -5, $max = 100),
        'f_max' => $faker->numberBetween($min = -5, $max = 100),
        'city_id' => function () {
            return factory(App\City::class)->create()->id;
        },
        'weather_id' => function () {
            return factory(App\Weather::class)->create()->id;
        }
    ];
});
