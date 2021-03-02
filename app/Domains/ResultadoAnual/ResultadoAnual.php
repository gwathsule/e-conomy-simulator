<?php

namespace App\Domains\ResultadoAnual;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $ano
 * @property float $pib
 * @property float $previsao_anual
 * @property float $yd
 * @property float $pib_consumo
 * @property float $pib_investimento_potencial
 * @property float $pib_investimento_realizado
 * @property float $gastos_governamentais
 * @property float $transferencias
 * @property float $impostos
 * @property float $bs
 * @property float $titulos
 * @property float $juros_divida_interna
 * @property float $caixa
 * @property float $divida_total
 * @property float $taxa_de_juros_base
 * @property float $efmk
 * @property float $investimento_em_titulos
 * @property float $inflacao_total
 * @property float $inflacao_de_custo
 * @property float $inflacao_de_demanda
 * @property float $desemprego
 * @property float $pmgc
 * @property float $k
 * @property float $imposto_de_renda
 * @property float $k_com_imposto
 */
class ResultadoAnual extends Model
{
    protected $table = 'resultado_anual';
    public $timestamps = false;

    public function calcularBalancoAnual()
    {
        //TODO
    }
}