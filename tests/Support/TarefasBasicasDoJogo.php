<?php

namespace Tests\Support;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Domains\User\User;
use Illuminate\Support\Facades\Auth;

trait TarefasBasicasDoJogo
{
    public function iniciarjogo(User $user)
    {
        /** @var Jogo $dadosNovoJogo */
        $dadosNovoJogo = factory(Jogo::class)->make(['user_id' => null]);
        $data = [
            'pais' => $dadosNovoJogo->pais,
            'moeda' => $dadosNovoJogo->moeda,
            'ministro' => $dadosNovoJogo->ministro,
            'genero' => $dadosNovoJogo->genero,
            'personagem' => $dadosNovoJogo->personagem,
            'presidente' => $dadosNovoJogo->presidente,
            'descricao' => $dadosNovoJogo->descricao,
            'rodadas' => $dadosNovoJogo->rodadas,
        ];
        Auth::login($user);
        /** @var CriarNovoJogo $servico */
        $servico = app()->make(CriarNovoJogo::class);
        /** @var Jogo $jogo */
        return $servico->handle($data);
    }
}