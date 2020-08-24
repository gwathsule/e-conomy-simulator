<?php

namespace App\Domains\Evento;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $rodadas_restantes
 * @property array $noticia
 */
class Evento extends Model
{
    protected $table = 'evento';
}