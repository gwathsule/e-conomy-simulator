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
        for($i = 1; $i<12; $i++){
            $servico->handle($dataPadrao);
        }
        $jogo->refresh();
        $this->assertCount(12, $jogo->rodadas);
        $this->assertCount(2, $jogo->resultados_anuais);
        /** @var ResultadoAnual $resultado */
        $resultado = $jogo->resultados_anuais->last();
        $this->assertEquals(1, $resultado->ano);
    }

    //criar um teste igual ao da planilha
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
        for($i = 1; $i<24; $i++){
            $servico->handle($dataPadrao);
        }
        $jogo->refresh();
        $this->assertNotNull($jogo->id);
        $this->assertTrue($jogo->finalizado());
        $this->assertCount(24, $jogo->rodadas);
        $this->assertCount(3, $jogo->resultados_anuais);
        $this->assertTrue($jogo->finalizado());
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

        //2° rodada - abaixar imposto de renda em 1% (-1%);
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Diminuir imposto')->first()->id,
            'jogo_id' => $jogo->id,
        ]);
        //3° rodada - sem interferência
        $servico->handle($dataPadrao);
        //4° rodada - aumentar transferencias em $180.000,00 (+180.000)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Aumentar investimento social')->first()->id,
            'jogo_id' => $jogo->id,
        ]);
        //5° rodada - sem interferência
        $servico->handle($dataPadrao);
        //6° rodada - Abaixar taxa de juros em 1% (-1%)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Diminuir taxa de juros')->first()->id,
            'jogo_id' => $jogo->id,
        ]);
        //7° rodada - sem interferência
        $servico->handle($dataPadrao);
        //8° rodada - Aumentar Gastos Governamentais em $100.000,00 (+100.000)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Investir em Educação')->first()->id,
            'jogo_id' => $jogo->id,
        ]);
        //9° rodada - sem interferência
        $servico->handle($dataPadrao);
        //10° rodada - Aumentar Gastos Governamentais em $100.000,00 (+100.000)
        $servico->handle([
            'medida_id' => Medida::query()->where('nome','Investir em Saúde')->first()->id,
            'jogo_id' => $jogo->id,
        ]);
        //11° rodada - sem interferência
        $servico->handle($dataPadrao);
        //12° rodada - sem interferência
        $servico->handle($dataPadrao);
        //13° rodada - sem interferência
        $servico->handle($dataPadrao);
        $jogo->refresh();
        $this->assertNotNull($jogo->id);

        $this->assertCount(2, $jogo->resultados_anuais);
        $this->assertCount(13, $jogo->rodadas);
        //TODO verificar os valores do primeiro ano se batem com a da planilha
    }
}