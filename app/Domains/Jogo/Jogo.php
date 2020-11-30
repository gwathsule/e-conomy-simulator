<?php

namespace App\Domains\Jogo;

use App\Domains\ConfiguracoesGerais\ConfiguracoesGerais;
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
 * @property array $resultado_anual informa as variáveis econômicas de cada ano
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
        'resultado_anual' => 'array',
    ];

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

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function getImagemPersonagem()
    {
        return Personagem::getPersonagem($this->personagem);
    }

    public function getResultadosAgregados()
    {
        $resultados[0] = [
            'gastos_governamentais' => ConfiguracoesGerais::GASTOS_GOVERNAMENTAIS_ANO_ANTERIOR,
            'investimentos' => ConfiguracoesGerais::INVESTIMENTOS_ANO_ANTERIOR,
            'impostos' => ConfiguracoesGerais::IMPOSTOS_ANO_ANTERIOR,
            'transferencias' => ConfiguracoesGerais::TRANSFERENCIAS_ANO_ANTERIOR,
            'consumo' => ConfiguracoesGerais::CONSUMO_ANO_ANTERIOR,
            'pib' => ConfiguracoesGerais::PIB_ANO_ANTERIOR,
        ];

        $resultados[1] = $this->rodadas->slice(0, 12)->reduce(function ($carry, Rodada $item) {
               $carry['consumo'] += $item->consumo();
               $carry['gastos_governamentais'] += $item->gastos_governamentais;
               $carry['investimentos'] += $item->investimentos;
               $carry['impostos'] += $item->impostos();
               $carry['transferencias'] += $item->transferencias;
               $carry['pib'] += $item->pib();
               return $carry;
        }, ['gastos_governamentais' => 0, 'investimentos' => 0, 'impostos' => 0, 'transferencias' => 0, 'consumo' => 0, 'pib' => 0]);

        if(($this->rodadas->count() > 12)) {
            $resultados[2] = $this->rodadas->slice(12, 24)->reduce(function ($carry, Rodada $item) {
                $carry['consumo'] += $item->consumo();
                $carry['gastos_governamentais'] += $item->gastos_governamentais;
                $carry['investimentos'] += $item->investimentos;
                $carry['impostos'] += $item->impostos();
                $carry['transferencias'] += $item->transferencias;
                $carry['pib'] += $item->pib();
                return $carry;
            }, ['gastos_governamentais' => 0, 'investimentos' => 0, 'impostos' => 0, 'transferencias' => 0, 'consumo' => 0, 'pib' => 0]);
        }

        return $resultados;
    }
}
