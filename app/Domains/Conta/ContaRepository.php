<?php

namespace App\Domains\Conta;

use App\Support\Repository;

class ContaRepository extends Repository
{
    public function getModel(): string
    {
        return Conta::class;
    }
}