<?php

namespace App\Support;

use App\Domains\Jogo\Jogo;

abstract class Evento
{
    abstract protected function getCode(): string;

    /**
     * Método a ser executado quando as rodadas do Evento chegar a 0
     * @param Jogo $jogo
     * @param array $data
     * @return Noticia
     */
    abstract protected function modificacoes(Jogo $jogo, array $data) : Noticia;
}