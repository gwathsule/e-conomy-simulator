<?php

namespace Jogo;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\Services\CriarNovoJogo;
use App\Domains\ResultadoAnual\ResultadoAnual;
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
        $this->assertNotNull($jogo);
        /** @var ResultadoAnual $anoAnterior */
        $anoAnterior = $jogo->resultados_anuais->first();
        $prRodada = $jogo->rodadas->first()->toInformation();

        $this->assertEquals($anoAnterior->ano, 0);
        $this->assertEquals($anoAnterior->pib, 59224000.000);
        $this->assertEquals($anoAnterior->previsao_anual, 0.030);
        $this->assertEquals($anoAnterior->yd, 54492000.000);
        $this->assertEquals($anoAnterior->pib_consumo, 39034000.000);
        $this->assertEquals($anoAnterior->pib_investimento_potencial, 18000000.000);
        $this->assertEquals($anoAnterior->pib_investimento_realizado, 16830000.000);
        $this->assertEquals($anoAnterior->gastos_governamentais, 3360000.000);
        $this->assertEquals($anoAnterior->transferencias, 2000000.000);
        $this->assertEquals($anoAnterior->impostos, 6732000.000);
        $this->assertEquals($anoAnterior->bs, 1372000.000);
        $this->assertEquals($anoAnterior->titulos, 1170000.000);
        $this->assertEquals($anoAnterior->juros_divida_interna, 105300.000);
        $this->assertEquals($anoAnterior->caixa, 96700.000);
        $this->assertEquals($anoAnterior->divida_total, 1275300.000);
        $this->assertEquals($anoAnterior->taxa_de_juros_base, 0.090);
        $this->assertEquals($anoAnterior->efmk, 0.077);
        $this->assertEquals($anoAnterior->investimento_em_titulos, 0.065);
        $this->assertEquals($anoAnterior->inflacao_total, 0.030);
        $this->assertEquals($anoAnterior->inflacao_de_custo, 0.015);
        $this->assertEquals($anoAnterior->inflacao_de_demanda, 0.015);
        $this->assertEquals($anoAnterior->desemprego, 0.070);
        $this->assertEquals($anoAnterior->pmgc, 0.700);
        $this->assertEquals($anoAnterior->k, 3.333);
        $this->assertEquals($anoAnterior->imposto_de_renda, 0.120);
        $this->assertEquals($anoAnterior->k_com_imposto, 2.933);

        $this->assertEquals(number_format($prRodada['pib'], 2, '.', ''), 4935333.33);
        $this->assertEquals(number_format($prRodada['yd'], 2, '.', ''), 4541000.00);
        $this->assertEquals(number_format($prRodada['pib_consumo'], 2, '.', ''), 3252833.33);
        $this->assertEquals(number_format($prRodada['pib_investimento_potencial'], 2, '.', ''), 1500000.00);
        $this->assertEquals(number_format($prRodada['pib_investimento_realizado'], 2, '.', ''), 1402500.00);
        $this->assertEquals(number_format($prRodada['gastos_governamentais'], 2, '.', ''), 280000.00);
        $this->assertEquals(number_format($prRodada['transferencias'], 2, '.', ''), 166666.67);
        $this->assertEquals(number_format($prRodada['impostos'], 2, '.', ''), 561000.00);
        $this->assertEquals(number_format($prRodada['bs'], 2, '.', ''), 114333.33);
        $this->assertEquals(number_format($prRodada['titulos'], 2, '.', ''), 97500.00);
        $this->assertEquals(number_format($prRodada['juros_divida_interna'], 2, '.', ''), 8775.00);
        $this->assertEquals(number_format($prRodada['caixa'], 2, '.', ''), 211033.33);
        $this->assertEquals(number_format($prRodada['divida_total'], 2, '.', ''), 106275.00);
        $this->assertEquals(number_format($prRodada['taxa_de_juros_base'], 2, '.', ''), 0.09);
        $this->assertEquals(number_format($prRodada['efmk'], 2, '.', ''), 0.08);
        $this->assertEquals(number_format($prRodada['investimento_em_titulos'], 2, '.', ''), 0.07);
        $this->assertEquals(number_format($prRodada['inflacao_total'], 2, '.', ''), 0.03);
        $this->assertEquals(number_format($prRodada['inflacao_de_custo'], 2, '.', ''), 0.02);
        $this->assertEquals(number_format($prRodada['inflacao_de_demanda'], 2, '.', ''), 0.02);
        $this->assertEquals(number_format($prRodada['desemprego'], 2, '.', ''), 0.07);
        $this->assertEquals($prRodada['popularidade_empresarios'], 0.5);
        $this->assertEquals($prRodada['popularidade_trabalhadores'], 0.5);
        $this->assertEquals($prRodada['popularidade_estado'], 0.5);
        $this->assertEquals(number_format($prRodada['pmgc'], 2, '.', ''), 0.70);
        $this->assertEquals(number_format($prRodada['k'], 2, '.', ''), 3.33);
        $this->assertEquals(number_format($prRodada['imposto_de_renda'], 2, '.', ''), 0.12);
        $this->assertEquals(number_format($prRodada['k_com_imposto'], 2, '.', ''), 2.93);
    }
}
