<?php

namespace App\Domains\Momento;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property int $pib
 * @property array $medida
 * @property array $noticias
 */
class Momento extends Model
{
    protected $table = 'momento';
}
