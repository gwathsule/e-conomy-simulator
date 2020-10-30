<?php

namespace App\Domains\Rodada;

use App\Support\Repository;

class RodadaRepository extends Repository
{
    public function getModel(): string
    {
        return Rodada::class;
    }
}
