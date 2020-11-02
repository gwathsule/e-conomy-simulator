<?php

namespace Jogo;

use App\Domains\ConfiguracoesGerais\ConfiguracoesGerais;
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
            'presidente' => $dadosNovoJogo->presidente,
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
        $this->assertEquals(ConfiguracoesGerais::QTD_RODADAS, $jogo->qtd_rodadas);
        $this->assertCount(1, $jogo->rodadas);
        $this->assertCount(2, $jogo->eventos);
        /** @var Rodada $primeiraRodada */
        $primeiraRodada = $jogo->rodadas()->first();
        $this->assertEquals($jogo->id, $primeiraRodada->jogo_id);
        $this->assertEquals(0, $primeiraRodada->rodada);
        $this->assertEquals(ConfiguracoesGerais::PIB_PREVISAO_ANUAL_INICIAL, $primeiraRodada->pib_previsao_anual);
        $this->assertEquals(ConfiguracoesGerais::INVESTIMENTOS_POR_RODADA, $primeiraRodada->total_investimentos_anual);
        $this->assertEquals(ConfiguracoesGerais::INVESTIMENTOS_POR_RODADA, $primeiraRodada->investimentos_mesal);
        $this->assertEquals(ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS_POR_RODADA, $primeiraRodada->total_gastos_governamentais_anual);
        $this->assertEquals(ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS_POR_RODADA, $primeiraRodada->gastos_governamentais_mensal);
        $this->assertEquals(0, $primeiraRodada->total_transferencias_anual);
        $this->assertEquals(ConfiguracoesGerais::IMPOSTO_DE_RENDA_INICIAL, $primeiraRodada->imposto_renda);
        $this->assertEquals(ConfiguracoesGerais::POPULACAO_INICIAL, $primeiraRodada->populacao);
        $this->assertEquals(ConfiguracoesGerais::PMGC_INICIAL, $primeiraRodada->pmgc);
        $this->assertEquals([], $primeiraRodada->medidas);
        $this->assertEquals([], $primeiraRodada->noticias);
        /** @var Evento $eventoInicialPib */
        $eventoInicialPib = $jogo->eventos()->where('code', CalcularPrevisaoAnualPIB::CODE)->first();
        $this->assertEquals(3, $eventoInicialPib->rodadas_restantes);
        $this->assertEquals(CalcularPrevisaoAnualPIB::CODE, $eventoInicialPib->code);
        $this->assertEquals([], $eventoInicialPib->data);
    }
}
