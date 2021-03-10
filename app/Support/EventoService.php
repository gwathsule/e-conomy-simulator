<?php

namespace App\Support;

use App\Domains\Rodada\Rodada;
use App\Domains\Evento\Evento;

abstract class EventoService
{
    /** codigo do evento */
    abstract public function getCode(): string;

    /**
     * @param Rodada $rodada
     * @param Evento $evento
     * @return mixed
     */
    abstract public function modificacoes(Rodada $rodada, Evento $evento);
}