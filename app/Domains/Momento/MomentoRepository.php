<?php

namespace App\Domains\Momento;

use App\Support\Repository;

class MomentoRepository extends Repository
{
    public function getModel(): string
    {
        return Momento::class;
    }
}
