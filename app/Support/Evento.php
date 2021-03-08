<?php

namespace App\Support;

use App\Domains\Rodada\Rodada;
use App\Domains\Evento\Evento;

abstract class EventoService
{
    /** codigo do evento */
    abstract public function getCode(): string;

    /**
     * Método a ser executado quando as rodadas do Evento chegar a 0
     * @param Rodada $rodada
     * @param array $data
     * @return array
     */
    abstract public function modificacoes(Rodada $rodada, Evento $evento) : array;
}