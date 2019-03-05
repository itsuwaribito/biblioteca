<?php

use Faker\Generator as Faker;

$factory->define(App\Libro::class, function (Faker $faker) {
    return [
        'titulo' => $faker->company,
        'autor' => "$faker->name $faker->lastName",
        'editorial' => $faker->city,
        'edicion' => $faker->date('Y'),
        'publicacion' => $faker->date('Y'),
        'adquisicion' => $faker->dateTimeBetween('-5 years', 'now'),
        'observaciones' => $faker->text(100),
        'ubicaciones_id' => $faker->numberBetween(1,14)
    ];
});
