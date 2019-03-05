<?php

use Faker\Generator as Faker;

$factory->define(App\Alumno::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'apellido_paterno' => $faker->lastName,
        'apellido_materno' => $faker->lastName,
        'numero_control' => $faker->randomNumber(7),
    ];
});
