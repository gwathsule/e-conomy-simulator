<?php

namespace App\Domains\Jogo;

use App\Domains\Evento\Evento;
use App\Domains\Rodada\Rodada;
use App\Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property string $pais
 * @property string $presidente
 * @property string $genero
 * @property int $personagem
 * @property string $ministro
 * @property string $moeda
 * @property string $descricao
 * @property boolean $ativo
 * @property int $qtd_rodadas
 * @property int $user_id
 * @property User $user
 * @property Collection $rodadas
 * @property Collection $eventos
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

    public function rodadas()
    {
        return $this->hasMany(Rodada::class);
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
