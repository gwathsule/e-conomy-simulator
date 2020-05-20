<?php

namespace App\Domains\Timeline;

use App\Domains\Crisis\Crisis;
use App\Domains\Decision\Decision;
use App\Domains\News\News;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $round
 * @property float $pib measured in trillions ( pib * 1 trillion)
 * @property float $unemployment_tax
 * @property float $inflation
 * @property string $measure_code
 * @property string $measure_value
 * @property boolean $decision_choice
 * @property int $decision_id
 * @property int $game_id
 * @property int $news_id
 * @property int $crisis_id
 */
class Timeline extends Model
{
    protected $table = 'timeline';

    protected $casts = [
        'decision_choice' => 'bool',
    ];

    public function decision()
    {
        return $this->belongsTo(Decision::class);
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function crisis()
    {
        return $this->belongsTo(Crisis::class);
    }
}
