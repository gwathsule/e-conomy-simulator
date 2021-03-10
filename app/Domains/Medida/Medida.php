<?php

namespace App\Domains\Medida;

use App\Domains\Jogo\Jogo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $codigo_evento
 * @property string $nome
 * @property string $resumo
 * @property boolean $medida_imediata
 * @property string $url_imagem
 * @property string $tipo_noticia
 * @property string $texto_noticia
 * @property string $titulo_noticia
 * @property float $diferenca_financas
 * @property float $diferenca_popularidade_empresarios
 * @property float $diferenca_popularidade_trabalhadores
 * @property float $diferenca_popularidade_estado
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

    public function buildTituloNoticia(Jogo $jogo)
    {
        return $this->buildText($this->titulo_noticia, $jogo);
    }

    public function buildTextoNoticia(Jogo $jogo)
    {
        return $this->buildText($this->texto_noticia, $jogo);
    }

    private function buildText(string $texto, Jogo $jogo) : string
    {
        $texto = Str::replaceFirst('{a/o}', $jogo->genero == 'M' ? 'o' : 'a', $texto);
        $texto = Str::replaceFirst('{ministro/a}', $jogo->genero == 'M' ? 'ministro' : 'ministra', $texto);
        $texto = Str::replaceFirst('{nomeMinistro}', $jogo->ministro, $texto);
        $texto = Str::replaceFirst('{moeda}', $jogo->moeda, $texto);
        $texto = Str::replaceFirst('{pais}', $jogo->pais, $texto);
        return $texto;
    }
}