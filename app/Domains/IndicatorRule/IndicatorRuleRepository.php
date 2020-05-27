<?php

namespace App\Domains\IndicatorRule;

use App\Support\Repository;

class IndicatorRuleRepository extends Repository
{

    public function getModel(): string
    {
        return IndicatorRule::class;
    }

    public function getAllConditions()
    {
        return IndicatorRule::ALL_CONDITIONS;
    }

    public function getAllTypes()
    {
        return IndicatorRule::ALL_TYPES;
    }
}
