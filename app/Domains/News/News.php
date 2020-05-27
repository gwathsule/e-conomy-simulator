<?php

namespace App\Domains\News;

use App\Domains\IndicatorRule\IndicatorRule;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image_url
 * @property string $newscast
 * @property int $indicator_rule_id
 * @property IndicatorRule $indicator_rule
 */
class News extends Model
{
    protected $table = 'news';

    public function getPathUrl()
    {
        return "news/$this->id/";
    }

    public function indicator_rule()
    {
        return $this->belongsTo(IndicatorRule::class);
    }
}
