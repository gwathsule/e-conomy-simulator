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
        $prRodada = $jogo->rodadas->first();

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
    }
}
