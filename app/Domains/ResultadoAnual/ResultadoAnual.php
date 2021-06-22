<?php

namespace App\Domains\ResultadoAnual;

use App\Domains\Jogo\Jogo;
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
 * @property float $popularidade_empresarios
 * @property float $popularidade_trabalhadores
 * @property float $popularidade_estado
 * @property Jogo $jogo
 */
class ResultadoAnual extends Model
{
    protected $table = 'resultado_anual';
    public $timestamps = false;

    public function jogo()
    {
        return $this->belongsTo(Jogo::class);
    }

    public function compararResultados(ResultadoAnual $anterior)
    {
        return [
            'pib' => round(($this->pib / $anterior->pib - 1), 2),
            'previsao_anual' => round(($this->previsao_anual / $anterior->previsao_anual - 1), 2),
            'yd' => round(($this->yd / $anterior->yd - 1), 2),
            'pib_consumo' => round(($this->pib_consumo / $anterior->pib_consumo - 1), 2),
            'pib_investimento_potencial' => round(($this->pib_investimento_potencial / $anterior->pib_investimento_potencial - 1), 2),
            'pib_investimento_realizado' => round(($this->pib_investimento_realizado / $anterior->pib_investimento_realizado - 1), 2),
            'gastos_governamentais' => round(($this->gastos_governamentais / $anterior->gastos_governamentais - 1), 2),
            'transferencias' => round(($this->transferencias / $anterior->transferencias - 1), 2),
            'impostos' => round(($this->impostos / $anterior->impostos - 1), 2),
            'bs' => round(($this->bs / $anterior->bs - 1), 2),
            'titulos' => round(($this->titulos / $anterior->titulos - 1), 2),
            'juros_divida_interna' => round(($this->juros_divida_interna / $anterior->juros_divida_interna - 1), 2),
            'caixa' => round(($this->caixa / $anterior->caixa - 1), 2),
            'divida_total' => round(($this->divida_total / $anterior->divida_total - 1), 2),
            'taxa_de_juros_base' => $this->taxa_de_juros_base - $anterior->taxa_de_juros_base,
            'efmk' => $this->efmk - $anterior->efmk,
            'investimento_em_titulos' => $this->investimento_em_titulos - $anterior->investimento_em_titulos,
            'inflacao_total' => $this->inflacao_total - $anterior->inflacao_total,
            'inflacao_de_custo' => $this->inflacao_de_custo - $anterior->inflacao_de_custo,
            'inflacao_de_demanda' => $this->inflacao_de_demanda - $anterior->inflacao_de_demanda,
            'desemprego' => $this->desemprego - $anterior->desemprego,
            'pmgc' => $this->pmgc - $anterior->pmgc,
            'k' => $this->k - $anterior->k,
            'imposto_de_renda' => $this->imposto_de_renda - $anterior->imposto_de_renda,
            'k_com_imposto' => $this->k_com_imposto - $anterior->k_com_imposto,
            'popularidade_empresarios' => $this->popularidade_empresarios - $anterior->popularidade_empresarios,
            'popularidade_trabalhadores' => $this->popularidade_trabalhadores - $anterior->popularidade_trabalhadores,
            'popularidade_estado' => $this->popularidade_estado - $anterior->popularidade_estado,
        ];
    }
}