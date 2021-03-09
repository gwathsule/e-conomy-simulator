<?php

namespace Rodada;

use App\Domains\Medida\Medida;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\Rodada\Services\CriarNovaRodada;
use App\Domains\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\TarefasBasicasDoJogo;
use Tests\TestCase;

class RodadaTest extends TestCase
{
    use RefreshDatabase, TarefasBasicasDoJogo;

    public function testProgressoDe1AnoSemIntervencaoDoUsuario()
    {
        $user = factory(User::class)->create();
        $jogo = $this->iniciarjogo($user);
        /** @var CriarNovaRodada $servico */
        $servico = app()->make(CriarNovaRodada::class);
        $dataPadrao = [
            'medida_id' => null,
            'jogo_id' => $jogo->id,
        ];
        for($i = 1; $i<13; $i++){
            $servico->handle($dataPadrao);
        }
        $jogo->refresh();
        $this->assertCount(13, $jogo->rodadas);
        $this->assertCount(2, $jogo->resultados_anuais);
        /** @var ResultadoAnual $resultado */
        $resultado = $jogo->resultados_anuais->last();

        $this->assertEquals(1, $resultado->ano);
        $this->assertEquals(59224000, round($resultado->pib));
        $this->assertEquals(2000000, round($resultado->transferencias));
        $this->assertEquals(6732000, round($resultado->impostos));
        $this->assertEquals(54492000, round($resultado->yd));
        $this->assertEquals(39034000, round($resultado->pib_consumo));
        $this->assertEquals(18000000, round($resultado->pib_investimento_potencial));
        $this->assertEquals(16830000, round($resultado->pib_investimento_realizado));
        $this->assertEquals(3360000, round($resultado->gastos_governamentais));
        $this->assertEquals(1372000, round($resultado->bs));
        $this->assertEquals(1170000, round($resultado->titulos));
        $this->assertEquals(105300, round($resultado->juros_divida_interna));
        $this->assertEquals(193400, round($resultado->caixa));
        $this->assertEquals(1275300, round($resultado->divida_total));
        $this->assertEquals(0.090, $resultado->taxa_de_juros_base);
        $this->assertEquals(0.077, $resultado->efmk);
        $this->assertEquals(0.065, $resultado->investimento_em_titulos);
        $this->assertEquals(0.030, $resultado->inflacao_total);
        $this->assertEquals(0.015, $resultado->inflacao_de_custo);
        $this->assertEquals(0.015, $resultado->inflacao_de_demanda);
        $this->assertEquals(0.070, $resultado->desemprego);
        $this->assertEquals(0.700, $resultado->pmgc);
        $this->assertEquals(3.333, $resultado->k);
        $this->assertEquals(0.120, $resultado->imposto_de_renda);
        $this->assertEquals(2.933, $resultado->k_com_imposto);
    }

    //criar um teste igual ao da planilha
    public function testProgressoDe2AnosComIntervencaoDoUsuario()
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
        $this->assertNotNull($jogo->id);
    }


    //criar um teste igual ao da planilha
    public function testProgressoDe1AnoComIntervencaoDoUsuario()
    {
        $this->iniciarMedidas();
        $user = factory(User::class)->create();
        $jogo = $this->iniciarjogo($user);
        /** @var CriarNovaRodada $servico */
        $servico = app()->make(CriarNovaRodada::class);
        $dataPadrao = [
            'medida_id' => null,
            'jogo_id' => $jogo->id,
        ];

        //1° rodada - sem interferência
        $servico->handle($dataPadrao);

        //2° rodada - abaixar imposto de renda em 1% (-1%);
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Abaixar Imposto de Renda')->first()->id,
            'jogo_id' => $jogo->id,
        ]);

        //3° rodada - sem interferência
        $servico->handle($dataPadrao);

        //4° rodada - aumentar transferencias em $180.000,00 (+180.000)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Aumentar Transferencias')->first()->id,
            'jogo_id' => $jogo->id,
        ]);

        //5° rodada - sem interferência
        $servico->handle($dataPadrao);

        //6° rodada - Abaixar taxa de juros em 1% (-1%)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Abaixar taxa de Juros')->first()->id,
            'jogo_id' => $jogo->id,
        ]);

        //7° rodada - sem interferência
        $servico->handle($dataPadrao);

        //8° rodada - Aumentar Gastos Governamentais em $100.000,00 (+100.000)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Investimento em Educação')->first()->id,
            'jogo_id' => $jogo->id,
        ]);

        //9° rodada - sem interferência
        $servico->handle($dataPadrao);

        //10° rodada - Aumentar Gastos Governamentais em $100.000,00 (+100.000)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Investimento em Saúde')->first()->id,
            'jogo_id' => $jogo->id,
        ]);

        //11° rodada - sem interferência
        $servico->handle($dataPadrao);

        //12° rodada - sem interferência
        $servico->handle($dataPadrao);

        $jogo->refresh();
        $this->assertNotNull($jogo->id);
    }
}