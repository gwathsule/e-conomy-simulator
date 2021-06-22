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
        $resultado->pib = $rodadasAno->sum('pib');
        $resultado->transferencias = $rodadasAno->sum('transferencias');
        $resultado->impostos = $rodadasAno->sum('impostos');
        $resultado->yd = $resultado->pib - $resultado->impostos + $resultado->transferencias;
        $resultado->pib_consumo = $rodadasAno->sum('pib_consumo');
        $resultado->pib_investimento_potencial = $rodadasAno->sum('pib_investimento_potencial');
        $resultado->pib_investimento_realizado = $rodadasAno->sum('pib_investimento_realizado');
        $resultado->gastos_governamentais = $rodadasAno->sum('gastos_governamentais');
        $resultado->bs = $rodadasAno->sum('bs');
        $resultado->titulos = $rodadasAno->sum('titulos');
        $resultado->juros_divida_interna = $rodadasAno->sum('juros_divida_interna');
        $resultado->caixa = $ultimaRodada->caixa - $ultimaRodada->divida_total;
        $resultado->divida_total = $ultimaRodada->divida_total;
        $resultado->taxa_de_juros_base = $ultimaRodada->taxa_de_juros_base;
        $resultado->efmk = $ultimaRodada->efmk;
        $resultado->investimento_em_titulos = $ultimaRodada->investimento_em_titulos;
        $resultado->inflacao_total = $rodadasAno->avg('inflacao_total');
        $resultado->inflacao_de_custo = $rodadasAno->avg('inflacao_de_custo');
        $resultado->inflacao_de_demanda = $rodadasAno->avg('inflacao_de_demanda');
        $resultado->desemprego = $ultimaRodada->desemprego;
        $resultado->pmgc = $ultimaRodada->pmgc;
        $resultado->k = 1/(1-$ultimoAno->pmgc);
        $resultado->imposto_de_renda = $ultimaRodada->imposto_de_renda;
        $resultado->k_com_imposto = 1/(1-$resultado->pmgc) * (1 - $resultado->imposto_de_renda);
        $resultado->previsao_anual = $ultimaRodada->previsao_anual;
        $resultado->popularidade_empresarios = $ultimaRodada->popularidade_empresarios;
        $resultado->popularidade_trabalhadores = $ultimaRodada->popularidade_trabalhadores;
        $resultado->popularidade_estado = $ultimaRodada->popularidade_estado;
        $resultado->save();
        return $resultado;
    }
}