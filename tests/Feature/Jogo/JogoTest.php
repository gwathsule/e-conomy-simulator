<?php

namespace Jogo;

use App\Domains\ConfiguracoesGerais\ResultadosIniciais;
use App\Domains\Evento\Evento;
use App\Domains\Evento\Eventos\CalcularPrevisaoAnualPIB;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Domains\Rodada\Rodada;
use App\Domains\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\Support\TarefasBasicasDoJogo;
use Tests\TestCase;

class JogoTest extends TestCase
{
    use RefreshDatabase, TarefasBasicasDoJogo;

    public function testCriarNovoJogo()
    {
        /** @var Jogo $dadosNovoJogo */
        $dadosNovoJogo = factory(Jogo::class)->make(['user_id' => null]);
        $data = [
            'pais' => $dadosNovoJogo->pais,
            'moeda' => $dadosNovoJogo->moeda,
            'ministro' => $dadosNovoJogo->ministro,
            'genero' => $dadosNovoJogo->genero,
            'personagem' => $dadosNovoJogo->personagem,
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
        $this->assertEquals(ResultadosIniciais::QTD_RODADAS, $jogo->qtd_rodadas);
        $this->assertCount(1, $jogo->rodadas);
        //$this->assertCount(2, $jogo->eventos);
        /** @var Rodada $primeiraRodada */
        $primeiraRodada = $jogo->rodadas()->first();
        $this->assertEquals($jogo->id, $primeiraRodada->jogo_id);
        $this->assertEquals(0, $primeiraRodada->rodada);
        $this->assertEquals(ResultadosIniciais::PIB_PREVISAO_ANUAL_INICIAL, $primeiraRodada->pib_previsao_anual);
        $this->assertEquals(ResultadosIniciais::INVESTIMENTOS_POR_RODADA, $primeiraRodada->investimentos);
        $this->assertEquals(ResultadosIniciais::INVESTIMENTOS_POR_RODADA, $primeiraRodada->investimentos_fixos);
        $this->assertEquals(ResultadosIniciais::GASTOS_GOVERNAMENTAIS_POR_RODADA, $primeiraRodada->gastos_governamentais);
        $this->assertEquals(ResultadosIniciais::GASTOS_GOVERNAMENTAIS_POR_RODADA, $primeiraRodada->gastos_governamentais_fixos);
        $this->assertEquals(0, $primeiraRodada->transferencias);
        $this->assertEquals(ResultadosIniciais::IMPOSTO_DE_RENDA_INICIAL, $primeiraRodada->imposto_renda);
        $this->assertEquals(ResultadosIniciais::POPULACAO_INICIAL, $primeiraRodada->populacao);
        $this->assertEquals(ResultadosIniciais::PMGC_INICIAL, $primeiraRodada->pmgc);
        $this->assertEquals(null, $primeiraRodada->medida_id);
        $this->assertEquals([], $primeiraRodada->noticias);
        ///** @var Evento $eventoInicialPib */
        //$eventoInicialPib = $jogo->eventos()->where('code', CalcularPrevisaoAnualPIB::CODE)->first();
        //$this->assertEquals(3, $eventoInicialPib->rodadas_restantes);
        //$this->assertEquals(CalcularPrevisaoAnualPIB::CODE, $eventoInicialPib->code);
        //$this->assertEquals([], $eventoInicialPib->data);
    }
}
