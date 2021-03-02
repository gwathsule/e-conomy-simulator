<?php

namespace App\Domains\Jogo;

use App\Domains\Evento\Evento;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\Rodada\Rodada;
use App\Domains\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property string $pais
 * @property string $genero
 * @property int $personagem
 * @property string $ministro
 * @property string $moeda
 * @property string $descricao
 * @property array $resultado_anual informa as variáveis econômicas de cada ano
 * @property boolean $ativo
 * @property int $qtd_rodadas
 * @property int $user_id
 * @property User $user
 * @property Collection $rodadas
 * @property Collection $resultados_anuais
 * @property Collection $eventos
 */
class Jogo extends Model
{
    protected $table = 'jogo';

    protected $casts = [
        'active' => 'boolean',
        'resultado_anual' => 'array',
    ];

    /**
     * @param int $roundNumber
     * @return Rodada | null
     */
    public function getRodada(int $roundNumber)
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

    public function resultados_anuais()
    {
        return $this->hasMany(ResultadoAnual::class);
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function getImagemPersonagem()
    {
        return Personagem::getPersonagem($this->personagem);
    }

    public function toArray()
    {
        return [
            'jogo' => $this->attributesToArray(),
            'rodadas' => $this->rodadas,
            'eventos' => $this->eventos,
            'resultados_anuais' => $this->resultados_anuais,
            'url_personagem' => $this->getImagemPersonagem()
        ];
    }
}
