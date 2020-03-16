<?php

namespace App\Domains\Governo;

use App\Governo;
use App\Support\Repository;
use Illuminate\Database\Eloquent\Model;

class GovernoRepository extends Repository
{
    public function getModel(): string
    {
        return Governo::class;
    }
}