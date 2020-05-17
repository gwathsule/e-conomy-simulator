<?php

namespace App\Domains\Crisis;

use App\Support\Repository;

class CrisisRepository extends Repository
{
    public function getModel(): string
    {
        return Crisis::class;
    }
}
