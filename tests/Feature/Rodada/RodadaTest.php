<?php

namespace Rodada;

use App\Domains\ConfiguracoesGerais\ConfiguracoesGerais;
use App\Domains\Rodada\Services\CriarNovaRodada;
use App\Domains\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\TarefasBasicasDoJogo;
use Tests\TestCase;

class RodadaTest extends TestCase
{
    use RefreshDatabase, TarefasBasicasDoJogo;

    public function testProgressoDe2AnosSemIntervencaoDoUsuario()
    {
        $user = factory(User::class)->create();
        $jogo = $this->iniciarjogo($user);
        /** @var CriarNovaRodada $servico */
        $servico = app()->make(CriarNovaRodada::class);
        $dataPadrao = [
            'medida_id' => null,
            'jogo_id' => $jogo->id,
        ];
        for($i = 0; $i<=22; $i++){
            $servico->handle($dataPadrao);
        }
        $jogo->refresh();
        $resultadosAgregados = $jogo->getResultadosAgregados();
        $this->assertEquals(ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS_ANO_ANTERIOR , $resultadosAgregados[0]['gastos_governamentais']);
        $this->assertEquals(ConfiguracoesGerais::INVESTIMENTOS_ANO_ANTERIOR , $resultadosAgregados[0]['investimentos']);
        $this->assertEquals(ConfiguracoesGerais::IMPOSTOS_ANO_ANTERIOR , $resultadosAgregados[0]['impostos']);
        $this->assertEquals(ConfiguracoesGerais::TRANSFERENCIAS_ANO_ANTERIOR , $resultadosAgregados[0]['transferencias']);
        $this->assertEquals(ConfiguracoesGerais::CONSUMO_ANO_ANTERIOR , $resultadosAgregados[0]['consumo']);
        $this->assertEquals(ConfiguracoesGerais::PIB_ANO_ANTERIOR , $resultadosAgregados[0]['pib']);
        // esses valores para comparação foi obtido através da planilha que fizemos para simular o jogo
        $this->assertEquals(round(12000000.0), round($resultadosAgregados[1]['gastos_governamentais']));
        $this->assertEquals(round(42000000.0), round($resultadosAgregados[1]['investimentos']));
        $this->assertEquals(round(28000000.0), round($resultadosAgregados[1]['impostos']));
        $this->assertEquals(round(0.0 ), round($resultadosAgregados[1]['transferencias']));
        $this->assertEquals(round(70000000.0), round($resultadosAgregados[1]['consumo']));
        $this->assertEquals(round(124000000), round($resultadosAgregados[1]['pib']));

        $this->assertEquals(round(12000000.0), round($resultadosAgregados[2]['gastos_governamentais']));
        $this->assertEquals(round(42000000.0), round($resultadosAgregados[2]['investimentos']));
        $this->assertEquals(round(28000000.0), round($resultadosAgregados[2]['impostos']));
        $this->assertEquals(round(0.0 ), round($resultadosAgregados[2]['transferencias']));
        $this->assertEquals(round(70000000.0 ), round($resultadosAgregados[2]['consumo']));
        $this->assertEquals(round(124000000 ), round($resultadosAgregados[2]['pib']));
    }
}