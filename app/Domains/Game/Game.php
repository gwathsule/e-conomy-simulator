<?php

namespace App\Domains\Game;

use App\Domains\Timeline\Timeline;
use App\Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property string $country_name
 * @property string $president_name
 * @property string $minister_name
 * @property string $currency_name
 * @property string $description
 * @property int $rounds
 * @property int $user_id
 * @property User $user
 * @property Collection $timelines
 */
class Game extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }
}
