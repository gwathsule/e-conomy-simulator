<?php
use Faker\Generator as Faker;
use App\Domains\User\User;
use App\Domains\Jogo\Jogo;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Jogo::class, function (Faker $faker) {
    return [
        'pais' => $faker->country,
        'presidente' => $faker->name,
        'ministro' => $faker->name,
        'moeda' => $faker->currencyCode,
        'genero' => $faker->randomElement(['M', 'F']),
        'personagem' => $faker->randomElement(\App\Domains\Jogo\Personagem::ALL),
        'ativo' => true,
        'qtd_rodadas' => \App\Domains\ConfiguracoesGerais\ConfiguracoesGerais::QTD_RODADAS,
        'user_id' => User::query()->exists()
            ? User::all()->random()
            : factory(User::class)->create(),
    ];
});
