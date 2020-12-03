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
 * @property float $diferenca_financas
 * @property int $diferenca_popularidade_empresarios
 * @property int $diferenca_popularidade_trabalhadores
 * @property int $diferenca_popularidade_estado
 */
class Medida extends Model
{
    public const TIPO_LIBERAL = 'liberal';
    public const TIPO_ESTATAL = 'estatal';

    public const TIPOS_MEDIDA = [
        self::TIPO_LIBERAL => 'Liberal',
        self::TIPO_ESTATAL => 'Estatal',
    ];

    protected $table = 'medida';
}