<?php

namespace App\Domains\Medida;

use App\Support\Repository;

class MedidaRepository extends Repository
{
    public function getModel(): string
    {
        return Medida::class;
    }

    public function getTiposDeMedida() : array
    {
        return Medida::TIPOS_MEDIDA;
    }
}