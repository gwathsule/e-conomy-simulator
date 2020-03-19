<?php

namespace App\Domains\Familia;

use App\Support\Repository;

class FamiliaRepository extends Repository
{
    public function getModel(): string
    {
        return Familia::class;
    }
}