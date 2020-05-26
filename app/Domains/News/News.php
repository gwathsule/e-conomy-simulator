<?php

namespace App\Domains\News;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image_url
 * @property string $indicator
 */
class News extends Model
{
    protected $table = 'news';

    public function getPathUrl()
    {
        return "news/$this->id/";
    }
}
