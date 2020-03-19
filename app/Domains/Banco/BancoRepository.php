<?php

namespace App\Domains\Banco;

use App\Support\Repository;

class BancoRepository extends Repository
{
    public function getModel(): string
    {
        return Banco::class;
    }
}