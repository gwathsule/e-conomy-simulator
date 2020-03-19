<?php

namespace App\Domains\Empresa;

use App\Support\Repository;

class EmpresaRepository extends Repository
{
    public function getModel(): string
    {
        return Empresa::class;
    }
}