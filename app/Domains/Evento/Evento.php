<?php

namespace App\Domains\Evento;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $rodadas_restantes
 * @property string $code
 * @property array $data
 */
class Evento extends Model
{
    protected $table = 'evento';

    protected $casts = [
        'data' => 'array',
    ];
}