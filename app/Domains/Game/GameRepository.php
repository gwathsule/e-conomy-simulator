<?php

namespace App\Domains\Game;

use App\Support\Repository;

class GameRepository extends Repository
{
    public function getModel(): string
    {
        return Game::class;
    }
}
