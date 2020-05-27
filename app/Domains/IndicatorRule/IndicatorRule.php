<?php

namespace App\Domains\IndicatorRule;

use App\Domains\Indicator\Indicator;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

/**
 * @property int $id
 * @property string $type
 * @property string $indicator
 * @property string $condition
 * @property string $value
 */
class IndicatorRule extends Model
{
    protected $table = 'indicator_rule';

    public const CONDITION_EQUALS_OR_LESS = '<=';
    public const CONDITION_EQUALS_OR_GREATER = '>=';
    public const CONDITION_CHANCE_OF_OCCURRENCE = 'chance_of_occurrence';
    public const TYPE_NEWS = 'news';
    public const TYPE_CRISES = 'crises';
    public const TYPE_DECISION = 'decision';

    public const ALL_TYPES = [
        self::TYPE_NEWS,
        self::TYPE_CRISES,
        self::TYPE_DECISION,
    ];

    public const ALL_CONDITIONS = [
        self::CONDITION_EQUALS_OR_LESS,
        self::CONDITION_EQUALS_OR_GREATER,
        self::CONDITION_CHANCE_OF_OCCURRENCE,
    ];

    public function description()
    {
        if(! is_null($this->indicator)) {
            return "SE " . Indicator::all()[$this->indicator] . ' FOR ' . $this->condition . ' QUE ' . $this->value . '%';
        } else {
            return 'SE HOUVER ' . $this->condition . ' DE ' . $this->value . '%';
        }
    }
}
