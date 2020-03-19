<?php

namespace App\Domains\Titulo;

use App\Domains\Emprestimo\Emprestimo;
use App\Support\Repository;

class TituloRespository extends Repository
{
    public function getModel(): string
    {
        return Emprestimo::class;
    }
}