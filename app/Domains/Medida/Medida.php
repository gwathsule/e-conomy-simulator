<?php

namespace App\Domains\Medida;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $codigo_evento
 * @property string $nome
 * @property string $rodadas_para_excutar
 * @property string $url_imagem
 * @property string $tipo_noticia
 * @property string $texto_noticia
 * @property string $titulo_noticia
 * @property float $diferenca_financas
 * @property int $diferenca_popularidade_empresarios
 * @property int $diferenca_popularidade_trabalhadores
 * @property int $diferenca_popularidade_estado
 */
class Medida extends Model
{
    public const TIPO_NOTICIA_LIBERAL = 'liberal';
    public const TIPO_NOTICIA_ESTATAL = 'estatal';

    public const TIPOS_NOTICIA = [
        self::TIPO_NOTICIA_LIBERAL => 'Liberal',
        self::TIPO_NOTICIA_ESTATAL => 'Estatal',
    ];

    protected $table = 'medida';

    public function getAvatarNoticia()
    {
        if($this->tipo_noticia == self::TIPO_NOTICIA_LIBERAL) return asset('img/resources/jn-liberal.png');
        if($this->tipo_noticia == self::TIPO_NOTICIA_ESTATAL) return asset('img/resources/jn-estatal.png');
    }

    public function getNomeJornal()
    {
        if($this->tipo_noticia == self::TIPO_NOTICIA_LIBERAL) return 'Jornal Liberal';
        if($this->tipo_noticia == self::TIPO_NOTICIA_ESTATAL) return 'Jornal Estatal';
    }
}