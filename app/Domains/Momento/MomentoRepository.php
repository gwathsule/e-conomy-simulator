<?php

namespace App\Domains\Timeline;

use App\Support\Repository;

class TimelineRepository extends Repository
{
    public function getModel(): string
    {
        return Momento::class;
    }
}
