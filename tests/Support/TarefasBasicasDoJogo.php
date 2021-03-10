<?php

namespace Tests\Support;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Domains\Medida\Medida;
use App\Domains\User\User;
use Illuminate\Support\Facades\Auth;

trait TarefasBasicasDoJogo
{
    public function iniciarjogo(User $user) : Jogo
    {
        /** @var Jogo $dadosNovoJogo */
        $dadosNovoJogo = factory(Jogo::class)->make(['user_id' => null]);
        $data = [
            'pais' => $dadosNovoJogo->pais,
            'moeda' => $dadosNovoJogo->moeda,
            'ministro' => $dadosNovoJogo->ministro,
            'genero' => $dadosNovoJogo->genero,
            'personagem' => $dadosNovoJogo->personagem,
            'rodadas' => $dadosNovoJogo->qtd_rodadas,
        ];
        Auth::login($user);
        /** @var CriarNovoJogo $servico */
        $servico = app()->make(CriarNovoJogo::class);
        /** @var Jogo $jogo */
        return $servico->handle($data);
    }

    public function iniciarMedidas()
    {
        $seeder = new \MedidasSeeder();
        $seeder->run();
    }
}