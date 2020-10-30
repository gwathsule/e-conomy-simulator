<?php

namespace App\Domains\Rodada;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property int $populacao
 * @property float $pib
 * @property float $pib_prox_ano
 * @property float $consumo
 * @property float $investimento
 * @property float $gastos_governamentais
 * @property float $transferencias
 * @property float $impostos
 * @property array $medidas
 * @property array $noticias
 */
class Rodada extends Model
{
    protected $table = 'rodada';

    protected $casts = [
        'medidas' => 'array',
        'noticias' => 'array',
    ];
}
