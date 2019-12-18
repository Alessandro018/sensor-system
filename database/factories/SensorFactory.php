<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sensor;
use Faker\Generator as Faker;

$factory->define(Sensor::class, function (Faker $faker) {
    return [
        'nome' => 'teste',
        'tipo' => 'temperatura'
    ];
});
