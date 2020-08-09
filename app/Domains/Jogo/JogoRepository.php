<?php

namespace App\Domains\Jogo;

use App\Support\Repository;

class JogoRepository extends Repository
{
    public function getModel(): string
    {
        return Jogo::class;
    }
}
