<?php

namespace App\Domains\User;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int        $id
 * @property string     $name
 * @property string     $email
 * @property string     $password
 * @property string     $remember_token
 * @property Carbon     $email_verified_at
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
}
