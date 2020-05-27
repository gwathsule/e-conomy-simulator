<?php

namespace App\Domains\IndicatorRule\Validators;

use App\Domains\Indicator\Indicator;
use App\Domains\IndicatorRule\IndicatorRule;
use App\Support\Validator;
use Illuminate\Validation\Rule;

class CreateNewsRuleValidator extends Validator
{
    public function attributes()
    {
        return [
            'indicator' => [
                'required',
                Rule::in(array_keys(Indicator::all())),
            ],
            'condition' => [
                'required',
                Rule::in(IndicatorRule::ALL_CONDITIONS),
            ],
            'value' => [
                'required',
                'numeric'
            ],
            'news_id' => [
                'required',
                'integer',
                'exists:news,id'
            ],
        ];
    }
}
