<?php

namespace App\Domains\Jogo;

use App\Domains\Momento\Momento;
use App\Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property string $pais
 * @property string $presidente
 * @property string $ministro
 * @property string $moeda
 * @property string $descricao
 * @property boolean $ativo
 * @property int $rodadas
 * @property int $populacao
 * @property int $pib
 * @property int $user_id
 * @property User $user
 * @property Collection $momentos
 */
class Jogo extends Model
{
    protected $table = 'jogo';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function getRound(int $roundNumber)
    {
        return $this->timelines->where('round', $roundNumber)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function momentos()
    {
        return $this->hasMany(Momento::class);
    }
}
