<?php

namespace App\Support;

use App\Domains\Jogo\Jogo;
use Illuminate\Support\Str;

class NoticiaBuilder
{
    public const TIPO_NOTICIA_LIBERAL = 'liberal';
    public const TIPO_NOTICIA_ESTATAL = 'estatal';

    public const TIPOS_NOTICIA = [
        self::TIPO_NOTICIA_LIBERAL => 'Liberal',
        self::TIPO_NOTICIA_ESTATAL => 'Estatal',
    ];

    //suporte para construir noticias
    public static function buildNoticiaCondicional($tipo, $titulo, $texto, $urlImagem, $medida, Jogo $jogo) : array
    {
        return [
            'tipo' => $tipo,
            'nome_jornal' => self::getNomeJornal($tipo),
            'avatar_jornal' => self::getAvatarNoticia($tipo),
            'titulo' => self::buildText($titulo, $jogo, $medida),
            'texto' => self::buildText($texto, $jogo, $medida),
            'imagem' => $urlImagem,
        ];
    }

    public static function getAvatarNoticia(string $tipoNoticia)
    {
        if($tipoNoticia == self::TIPO_NOTICIA_LIBERAL) return asset('img/resources/jn-liberal.png');
        if($tipoNoticia == self::TIPO_NOTICIA_ESTATAL) return asset('img/resources/jn-estatal.png');
    }

    public static function getNomeJornal(string $tipoNoticia)
    {
        if($tipoNoticia == self::TIPO_NOTICIA_LIBERAL) return 'Jornal Liberal';
        if($tipoNoticia == self::TIPO_NOTICIA_ESTATAL) return 'Jornal Estatal';
    }

    public static function buildText(string $texto, Jogo $jogo, $medida = null) : string
    {
        $texto = Str::replaceFirst('{a/o}', $jogo->genero == 'M' ? 'o' : 'a', $texto);
        $texto = Str::replaceFirst('{ministro/a}', $jogo->genero == 'M' ? 'ministro' : 'ministra', $texto);
        $texto = Str::replaceFirst('{nomeMinistro}', $jogo->ministro, $texto);
        $texto = Str::replaceFirst('{moeda}', $jogo->moeda, $texto);
        $texto = Str::replaceFirst('{pais}', $jogo->pais, $texto);
        if(! is_null($medida)) {
            $texto = Str::replaceFirst('{ultima_medida}', $medida, $texto);
        }
        return $texto;
    }
}