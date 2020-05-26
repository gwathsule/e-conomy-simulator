<?php

namespace App\Domains\News;

use App\Support\Repository;

class NewsRepository extends Repository
{

    public function getModel(): string
    {
        return News::class;
    }

    public function getAll()
    {
        return $this->newQuery()->get();
    }
}
