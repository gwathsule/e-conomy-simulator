<?php

namespace App\Domains\Contrato;

use App\Support\Repository;

class ContratoRepository extends Repository
{
    public function getModel(): string
    {
        return Contrato::class;
    }
}