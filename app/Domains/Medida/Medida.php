<?php

namespace App\Domains\Medida;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $codigo_evento
 * @property string $nome
 * @property string $rodadas_para_excutar
 * @property string $url_imagem
 * @property string $tipo
 * @property string $texto_noticia
 * @property float $diferenca
 */
class Medida extends Model
{
    public const TIPOS_MEDIDA = [
        'liberal' => 'Liberal',
        'estatal' => 'Estatal',
    ];

    protected $table = 'medida';
}