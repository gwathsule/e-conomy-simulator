<?php

namespace App\Domains\IndicatorRule;

use App\Support\Repository;

class IndicatorRuleRepository extends Repository
{

    public function getModel(): string
    {
        return IndicatorRule::class;
    }
}
