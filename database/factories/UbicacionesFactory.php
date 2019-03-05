<?php

use Faker\Generator as Faker;

$factory->define(App\Ubicacion::class, function (Faker $faker) {
    return [
        // 'estantes_id' => $faker->numberBetween(1,7),
        // 'secciones_id' => $faker->numberBetween(1,2),
    ];
});
