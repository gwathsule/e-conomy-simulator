<?php

namespace App\Domains\Evento;

use App\Support\Repository;

class EventoRepository extends Repository
{
    public function getModel(): string
    {
        return Evento::class;
    }
}