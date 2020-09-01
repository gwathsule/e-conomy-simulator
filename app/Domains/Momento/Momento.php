<?php

namespace App\Domains\Momento;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property float $pib
 * @property float $pib_prox_ano
 * @property float $pib_consumo
 * @property float $pib_investimento
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
