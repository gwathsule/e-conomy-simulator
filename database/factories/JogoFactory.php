<?php
use Faker\Generator as Faker;
use App\Domains\User\User;
use App\Domains\Jogo\Jogo;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Jogo::class, function (Faker $faker) {
    $populacao = config('jogo.inicio.qtd_populacao');
    $pib = $populacao * config('jogo.inicio.renda_anual_pessoa');
    $pib_consumo = $pib * config('jogo.pib.consumo');
    $pib_investimento = $pib * config('jogo.pib.investimento');
    return [
        'pais' => $faker->country,
        'presidente' => $faker->name,
        'ministro' => $faker->name,
        'moeda' => $faker->currencyCode,
        'descricao' => $faker->colorName,
        'ativo' => true,
        'rodadas' => 12,
        'populacao' => $populacao,
        'pib' => $pib,
        'pib_prox_ano' => config('jogo.pib.previsao_anual'),
        'pib_consumo' => $pib_consumo,
        'pib_investimento' => $pib_investimento,
        'user_id' => User::query()->exists()
            ? User::all()->random()
            : factory(User::class)->create(),
    ];
});
