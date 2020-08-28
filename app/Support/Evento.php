<?php

namespace App\Support;

use App\Domains\Jogo\Jogo;

abstract class Evento
{
    /** codigo do evento */
    abstract protected function getCode(): string;

    /** quantidade de rodadas que passa antes do evento disparar, caso o eveto for instantaneo, colocar 0 */
    abstract protected function getRodadas(): int;

    /**
     * Método a ser executado quando as rodadas do Evento chegar a 0
     * @param Jogo $jogo
     * @param array $data
     * @return Noticia
     */
    abstract public function modificacoes(Jogo $jogo, array $data) : Noticia;
}