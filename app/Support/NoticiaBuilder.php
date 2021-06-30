<?php

namespace App\Support;

use App\Domains\Jogo\Jogo;

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
        $texto = str_replace('{a/o}', $jogo->genero == 'M' ? 'o' : 'a', $texto);
        $texto = str_replace('{a/e}', $jogo->genero == 'M' ? 'e' : 'a', $texto);
        $texto = str_replace('{ministro/a}', $jogo->genero == 'M' ? 'ministro' : 'ministra', $texto);
        $texto = str_replace('{nomeMinistro}', $jogo->ministro, $texto);
        $texto = str_replace('{moeda}', $jogo->moeda, $texto);
        $texto = str_replace('{pais}', $jogo->pais, $texto);
        if(! is_null($medida)) {
            $texto = str_replace('{ultima_medida}', $medida, $texto);
        }
        return $texto;
    }
}