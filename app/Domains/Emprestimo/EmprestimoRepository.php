<?php

namespace App\Domains\Emprestimo;

use App\Support\Repository;

class EmprestimoRepository extends Repository
{
    public function getModel(): string
    {
        return Emprestimo::class;
    }
}