<?php

namespace App\Domains\Jogo;

use App\Support\Repository;

class GameRepository extends Repository
{
    public function getModel(): string
    {
        return Game::class;
    }
}
