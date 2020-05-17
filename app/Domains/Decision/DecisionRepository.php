<?php

namespace App\Domains\Decision;

use App\Support\Repository;

class DecisionRepository extends Repository
{
    public function getModel(): string
    {
        return Decision::class;
    }
}
