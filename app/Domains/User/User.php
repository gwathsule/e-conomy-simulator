<?php

namespace App\Domains\User;

use App\Domains\Jogo\Jogo;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $api_token
 * @property string $remember_token
 * @property boolean $is_admin
 * @property Carbon $email_verified_at
 * @property Collection $jogos
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

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    protected $attributes = [
        'is_admin' => false,
    ];

    /**
     * @return Jogo|null
     */
    public function getJogoAtivo()
    {
        return $this->jogos->where('ativo', true)->first();
    }

    public function jogos()
    {
        return $this->hasMany(Jogo::class);
    }

}
