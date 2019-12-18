<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Medicao;
use Faker\Generator as Faker;

$factory->define(Medicao::class, function (Faker $faker) {
    return [
        'sensor_id' => 1,
        'valor' => 50,
        'data_horario' => '2019-09-24-06:00'
    ];
});
