<?php

namespace App\Domains\Pessoa;

use App\Domains\Emprestimo\Emprestimo;
use App\Support\Repository;

class PessoaRepository extends Repository
{
    public function getModel(): string
    {
        return Emprestimo::class;
    }
}