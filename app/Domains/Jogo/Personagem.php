<?php

namespace App\Domains\Jogo;

class Personagem
{
    public const MINISTRO_0 = 0;
    public const MINISTRO_1 = 1;
    public const MINISTRO_2 = 2;
    public const MINISTRO_3 = 3;
    public const MINISTRO_4 = 4;

    public const MINISTRA_0 = 5;
    public const MINISTRA_1 = 6;
    public const MINISTRA_2 = 7;
    public const MINISTRA_3 = 8;
    public const MINISTRA_4 = 9;

    public const ALL = [
        self::MINISTRO_0,
        self::MINISTRO_1,
        self::MINISTRO_2,
        self::MINISTRO_3,
        self::MINISTRO_4,
        self::MINISTRA_0,
        self::MINISTRA_1,
        self::MINISTRA_2,
        self::MINISTRA_3,
        self::MINISTRA_4,
    ];

    public static function getPersonagem(int $code)
    {
        $url = null;
        if($code == self::MINISTRO_0) $url = asset('img/resources/pm01.png');
        if($code == self::MINISTRO_1) $url = asset('img/resources/pm02.png');
        if($code == self::MINISTRO_2) $url = asset('img/resources/pm03.png');
        if($code == self::MINISTRO_3) $url = asset('img/resources/pm04.png');
        if($code == self::MINISTRO_4) $url = asset('img/resources/pm05.png');
        if($code == self::MINISTRA_0) $url = asset('img/resources/pf01.png');
        if($code == self::MINISTRA_1) $url = asset('img/resources/pf02.png');
        if($code == self::MINISTRA_2) $url = asset('img/resources/pf03.png');
        if($code == self::MINISTRA_3) $url = asset('img/resources/pf04.png');
        if($code == self::MINISTRA_4) $url = asset('img/resources/pf05.png');
        if(is_null($url)) {
            return "";
        } else {
            return $url;
        }
    }
}
