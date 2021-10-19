<?php

namespace App\Domains\ResultadoAnual\Services;

use App\Domains\Jogo\Jogo;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\Rodada\Rodada;

class CriarResultadoAnual
{
    /**
     * @var Jogo
     */
    private $jogo;

    public function __construct(Jogo $jogo)
    {
        $this->jogo = $jogo;
    }

    public function perform()
    {
        /** @var ResultadoAnual $ultimoAno */
        $ultimoAno = $this->jogo->resultados_anuais->last();
        if($this->jogo->rodadas->count() == 12) {
            $rodadasAno = $this->jogo->rodadas->slice(0, 12);
        } else {
            $rodadasAno = $this->jogo->rodadas->slice(11);
        }
        /** @var Rodada $ultimaRodada */
        $ultimaRodada = $rodadasAno->last();
        $resultado = new ResultadoAnual();
        $resultado->ano = $this->jogo->rodadas->count() / 12;
        $resultado->jogo_id = $this->jogo->id;
        $q5 = $ultimaRodada->previsao_anual;
        $p4 = $rodadasAno->sum('pib') / $ultimoAno->pib - 1;
        $q9 = $rodadasAno->sum('pib_investimento_potencial') * ($p4+1);
        $q23 = $ultimaRodada->investimento_em_titulos;;
        $q10 = $q9*(1-$q23);
        $q11 = $rodadasAno->sum('gastos_governamentais');;
        $q34 = $ultimaRodada->pmgc;
        $q37 = $ultimaRodada->imposto_de_renda;
        $q38 = 1/(1-$q34)*(1-$q37);
        $q8 = ($q10*$q38)-$q10+($q11*$q38)-$q11;
        $q4 = $q8 + $q10 + $q11;
        $q12 = $rodadasAno->sum('transferencias');;
        $q13 = $rodadasAno->sum('impostos');
        $q7 = $q4 - $q13 + $q12;
        $q14 = $q13-$q11-$q12;
        $q16 = $q9-$q10;
        $q21 = $ultimaRodada->taxa_de_juros_base;
        $q17 = $q16*$q21;
        $q18 = $ultimaRodada->caixa - $ultimaRodada->divida_total;;
        $q19 = $ultimaRodada->divida_total;
        $q22 = $ultimaRodada->efmk;;
        $q25 = $rodadasAno->avg('inflacao_total');;
        $q26 = $rodadasAno->avg('inflacao_de_custo');;
        $q27 = $rodadasAno->avg('inflacao_de_demanda');;
        $q28 = $ultimaRodada->desemprego;;
        $q30 = $ultimaRodada->popularidade_empresarios;
        $q31 = $ultimaRodada->popularidade_trabalhadores;
        $q32 = $ultimaRodada->popularidade_estado;
        $q35 = 1/(1-$q34);

        $resultado->pib = $q4;
        $resultado->previsao_anual = $q5;
        $resultado->yd = $q7;
        $resultado->pib_consumo = $q8;
        $resultado->pib_investimento_potencial = $q9;
        $resultado->pib_investimento_realizado = $q10;
        $resultado->gastos_governamentais = $q11;
        $resultado->transferencias = $q12;
        $resultado->impostos = $q13;
        $resultado->bs = $q14;
        $resultado->titulos = $q16;
        $resultado->juros_divida_interna = $q17;
        $resultado->caixa = $q18;
        $resultado->divida_total = $q19;
        $resultado->taxa_de_juros_base = $q21;
        $resultado->efmk = $q22;
        $resultado->investimento_em_titulos = $q23;
        $resultado->inflacao_total = $q25;
        $resultado->inflacao_de_custo = $q26;
        $resultado->inflacao_de_demanda = $q27;
        $resultado->desemprego = $q28;
        $resultado->popularidade_empresarios = $q30;
        $resultado->popularidade_trabalhadores = $q31;
        $resultado->popularidade_estado = $q32;
        $resultado->pmgc = $q34;
        $resultado->k = $q35;
        $resultado->imposto_de_renda = $q37;
        $resultado->k_com_imposto = $q38;
        $resultado->save();
        return $resultado;
    }
}