<?php

namespace App\Domains\Timeline;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property float $pib
 * @property array $medida
 * @property array $noticias
 */
class Momento extends Model
{
    protected $table = 'timeline';
}
