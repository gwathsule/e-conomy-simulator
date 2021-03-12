<?php

namespace App\Domains\Rodada;

use App\Domains\Jogo\Jogo;
use App\Domains\Medida\Medida;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property float $pib_investimento_potencial
 * @property float $gastos_governamentais
 * @property float $transferencias
 * @property float $taxa_de_juros_base
 * @property float $inflacao_de_demanda
 * @property float $inflacao_de_custo
 * @property float $inflacao_total
 * @property float $pmgc
 * @property float $imposto_de_renda
 * @property float $pib
 * @property float $previsao_anual
 * @property float $yd
 * @property float $pib_consumo
 * @property float $pib_investimento_realizado
 * @property float $impostos
 * @property float $bs
 * @property float $efmk
 * @property float $titulos
 * @property float $juros_divida_interna
 * @property float $caixa
 * @property float $divida_total
 * @property float $investimento_em_titulos
 * @property float $desemprego
 * @property float $k
 * @property float $k_com_imposto
 * @property float $popularidade_empresarios
 * @property float $popularidade_trabalhadores
 * @property float $popularidade_estado
 * @property int $medida_id
 * @property array $noticias
 * @property Jogo $jogo
 * @property Medida $medida
 */
class Rodada extends Model
{
    protected $table = 'rodada';

    protected $casts = [
        'noticias' => 'array',
    ];

    public function jogo(){
        return $this->belongsTo(Jogo::class);
    }

    public function toInformation()
    {
        $valores = parent::attributesToArray();
        return $valores;
    }
}
