<?php

namespace App\Support;

use App\Domains\Medida\Medida;
use App\Domains\Rodada\Rodada;

abstract class Evento
{
    /** codigo do evento */
    abstract protected function getCode(): string;

    /**
     * Método a ser executado quando as rodadas do Evento chegar a 0
     * @param Rodada $rodada
     * @param array $data
     * @return array
     */
    abstract public function modificacoes(Rodada $rodada, Medida $medida) : array;
}