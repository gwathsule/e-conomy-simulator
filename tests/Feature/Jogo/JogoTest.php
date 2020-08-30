<?php

namespace Jogo;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Domains\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class JogoTest extends TestCase
{
    use RefreshDatabase;

    public function testCriarNovoJogo()
    {
        /** @var Jogo $dadosNovoJogo */
        $dadosNovoJogo = factory(Jogo::class)->make(['user_id' => null]);
        $data = [
            'pais' => $dadosNovoJogo->pais,
            'moeda' => $dadosNovoJogo->moeda,
            'ministro' => $dadosNovoJogo->ministro,
            'presidente' => $dadosNovoJogo->presidente,
            'descricao' => $dadosNovoJogo->descricao,
            'rodadas' => $dadosNovoJogo->rodadas,
            'populacao' => $dadosNovoJogo->populacao,
        ];
        Auth::login(factory(User::class)->create());
        /** @var CriarNovoJogo $servico */
        $servico = app()->make(CriarNovoJogo::class);
        /** @var Jogo $jogo */
        $jogo = $servico->handle($data);
        $this->assertNotNull($jogo->id);
        $this->assertEquals($dadosNovoJogo->pais, $jogo->pais);
        $this->assertEquals($dadosNovoJogo->moeda, $jogo->moeda);
        $this->assertEquals($dadosNovoJogo->ministro, $jogo->ministro);
        $this->assertEquals($dadosNovoJogo->presidente, $jogo->presidente);
        $this->assertEquals($dadosNovoJogo->descricao, $jogo->descricao);
        $this->assertEquals($dadosNovoJogo->rodadas, $jogo->rodadas);
        $this->assertEquals($data['populacao'] * config('jogo.inicio.renda_anual_pessoa'), $jogo->pib);
        $this->assertEquals(config('jogo.pib.previsao_anual'), $jogo->pib_prox_ano);
        $this->assertEquals($dadosNovoJogo->pib * config('jogo.pib.consumo'), $jogo->pib_consumo);
        $this->assertEquals($dadosNovoJogo->pib * config('jogo.pib.investimento'), $jogo->pib_investimento);
    }
}