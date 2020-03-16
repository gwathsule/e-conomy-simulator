<?php

use App\Domains\Governo\Governo;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Governo::class, function (Faker $faker) {
    return [
        'gasto' => $faker->randomFloat(2, 1, 100),
        'receita' => $faker->randomFloat(2, 1, 100),
        'imposto_renda' => $faker->randomFloat(2, 1, 100),
        'taxa_juros' => $faker->randomFloat(2, 1, 100),
        'taxa_deposito_compulsorio' => $faker->randomFloat(2, 1, 100),
        'salario_minimo' => $faker->randomFloat(2, 1, 100),
    ];
});
