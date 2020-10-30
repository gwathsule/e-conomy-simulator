<?php

namespace Jogo;

use App\Domains\ConfiguracoesGerais\ConfiguracoesGerais;
use App\Domains\Evento\Evento;
use App\Domains\Evento\Eventos\CalcularPrevisaoAnualPIB;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\Services\CriarNovaRodada;
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
            'descricao' => $dadosNovoJogo->descricao,
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
        $this->assertEquals(ConfiguracoesGerais::QTD_RODADAS, $jogo->qtd_rodadas);
        $this->assertCount(1, $jogo->rodadas);
        $this->assertCount(2, $jogo->eventos);
        /** @var Rodada $primeiraRodada */
        $primeiraRodada = $jogo->rodadas()->first();
        $this->assertEquals($jogo->id, $primeiraRodada->jogo_id);
        $this->assertEquals(0, $primeiraRodada->rodada);
        $this->assertEquals(ConfiguracoesGerais::PIB_ANO_ANTERIOR, $primeiraRodada->pib);
        $this->assertEquals(ConfiguracoesGerais::PREVISAO_ANUAL, $primeiraRodada->pib_prox_ano);
        $this->assertEquals(ConfiguracoesGerais::CONSUMO, $primeiraRodada->consumo);
        $this->assertEquals(ConfiguracoesGerais::INVESTIMENTO, $primeiraRodada->investimento);
        $this->assertEquals(ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS, $primeiraRodada->gastos_governamentais);
        $this->assertEquals(ConfiguracoesGerais::TRANSFERENCIAS, $primeiraRodada->transferencias);
        $this->assertEquals(ConfiguracoesGerais::IMPOSTOS, $primeiraRodada->impostos);
        $this->assertEquals([], $primeiraRodada->medidas);
        $this->assertEquals([], $primeiraRodada->noticias);
        /** @var Evento $eventoInicialPib */
        $eventoInicialPib = $jogo->eventos()->where('code', CalcularPrevisaoAnualPIB::CODE)->first();
        $this->assertEquals(3, $eventoInicialPib->rodadas_restantes);
        $this->assertEquals(CalcularPrevisaoAnualPIB::CODE, $eventoInicialPib->code);
        $this->assertEquals([], $eventoInicialPib->data);
    }

    public function testCicloCompleto()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        /** @var Jogo $jogo */
        $jogo = $this->iniciarjogo($user);
        $data = [
            'jogo_id' => $jogo->id,
            'medidas' => [],
        ];
        /** @var CriarNovaRodada $servico */
        $servico = app()->make(CriarNovaRodada::class);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $servico->handle($data);
        $jogo->refresh();
        $this->assertCount(14, $jogo->rodadas);
        $this->assertCount(2, $jogo->eventos);
        $this->assertEquals(13, $jogo->rodadas->last()->rodada);
        $this->assertCount(1, $jogo->rodadas[3]->noticias);
        $this->assertCount(1, $jogo->rodadas[6]->noticias);
        $this->assertCount(1, $jogo->rodadas[9]->noticias);
        $this->assertCount(2, $jogo->rodadas[12]->noticias);
        $this->assertNotEquals($jogo->rodadas[1]->pib, $jogo->rodadas[13]->pib);
    }
}
