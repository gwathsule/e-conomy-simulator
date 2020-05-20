<?php

namespace App\Domains\User;

use App\Domains\Game\Game;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property Carbon $email_verified_at
 * @property Collection $games
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'email_verified_at',
    ];

    /**
     * @return Game|null
     */
    public function getActiveGame()
    {
        return $this->games->where('active', true)->first();
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

}
