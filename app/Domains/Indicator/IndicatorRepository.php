<?php

namespace App\Domains\Indicator;

class IndicatorRepository
{
    public function getAll()
    {
        return Indicator::all();
    }
}
