<?php

namespace App\Domains\IndicatorRule;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $action
 * @property string $action_value
 * @property string $indicator
 * @property string $condition
 * @property string $value
 */
class IndicatorRule extends Model
{
    protected $table = 'indicator_rule';
}
