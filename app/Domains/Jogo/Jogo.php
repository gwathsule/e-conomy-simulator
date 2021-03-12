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
 * @property int $status
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

    public const STATUS_PERDIDO = -1;
    public const STATUS_EM_ANDAMENTO = 0;
    public const STATUS_VENCIDO = 1;

    protected $casts = [
        'active' => 'boolean',
        'resultado_anual' => 'array',
    ];

    /**
     * @param int $roundNumber
     * @return Rodada | null
     */
    public function getRodada(int $rodada)
    {
        return $this->rodadas->where('rodada', $rodada)->first();
    }

    /**
     * @param int $ano
     * @return mixed
     */
    public function getAno(int $ano)
    {
        return $this->resultados_anuais->where('ano', $ano)->first();
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

    public function finalizado()
    {
        if($this->status == self::STATUS_VENCIDO || $this->status == self::STATUS_PERDIDO) {
            return true;
        }
        return false;
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
