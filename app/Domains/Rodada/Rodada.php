<?php

namespace App\Domains\Rodada;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property int $populacao
 * @property float $pmgc
 * @property float $pib_ano_anterior
 * @property float $pib_previsao_anual
 * @property float $consumo
 * @property float $investimento
 * @property float $gastos_governamentais
 * @property float $transferencias
 * @property float $impostos
 * @property array $medidas
 * @property array $noticias
 */
class Rodada extends Model
{
    protected $table = 'rodada';

    protected $casts = [
        'medidas' => 'array',
        'noticias' => 'array',
    ];

    public function impostos()
    {

    }

    public function pibConsumo()
    {

    }

    public function pib()
    {

    }

    public function rendaDisponivel() : float
    {
        $pibInicial = $this->pib_ano_anterior + $this->transferencias;
        return $pibInicial + $this->transferencias - $this->impostos;
    }

    public function deficitOuSuperavit(): float
    {
        return $this->gastos_governamentais - $this->transferencias - $this->impostos;
    }

    public function multiplicadorK() : float
    {
        return 1/(1-$this->pmgc) * (1-$this->impostos);
    }

    public function toArray()
    {
        $valores = parent::toArray();
        $valores['renda_disponivel'] = $this->rendaDisponivel();
        $valores['deficit_ou_superavit'] = $this->deficitOuSuperavit();
        $valores['multiplicador_K'] = $this->multiplicadorK();
        return $valores;
    }
}
