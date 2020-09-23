<?php

namespace App\Domains\Momento;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
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
class Momento extends Model
{
    protected $table = 'momento';

    protected $casts = [
        'medidas' => 'array',
        'noticias' => 'array',
    ];
}
