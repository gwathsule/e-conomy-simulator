<?php

namespace App\Domains\Rodada;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property int $populacao
 * @property float $pmgc
 * @property float $imposto_renda
 * @property float $pib_previsao_anual
 * @property float $investimentos total dos investimentos da rodada
 * @property float $investimentos_fixos quantidade fixa de dinheiro de investimento que entra no PIB mensalmente
 * @property float $gastos_governamentais gastos do governo na rodada
 * @property float $gastos_governamentais_fixos quantidade fixa de dinheiro que o governo gasta mensalmente
 * @property float $transferencias total de transferencias realizada na rodada
 * @property float $popularidade_empresarios
 * @property float $popularidade_trabalhadores
 * @property float $popularidade_estado
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

    public function impostos() : float
    {
        return $this->investimentos * ($this->multiplicadorKSemImposto() - $this->multiplicadorKComImposto());
    }

    public function consumo() : float
    {
        return ($this->investimentos * $this->multiplicadorKComImposto()) - $this->investimentos;
    }

    public function pib() : float
    {
        return $this->consumo() + $this->investimentos + $this->gastos_governamentais;
    }

    public function rendaDisponivel() : float
    {
        return $this->pib() + $this->gastos_governamentais - $this->transferencias;
    }

    public function deficitOuSuperavit(): float
    {
        return $this->gastos_governamentais - $this->transferencias - $this->impostos();
    }

    public function multiplicadorKComImposto() : float
    {
        return 1/(1-$this->pmgc) * (1-$this->imposto_renda);
    }

    public function multiplicadorKSemImposto() : float
    {
        return 1/(1-$this->pmgc);
    }

    public function toArray()
    {
        $valores = parent::toArray();
        $valores['impostos'] = $this->impostos();
        $valores['consumo'] = $this->consumo();
        $valores['pib'] = $this->pib();
        $valores['renda_disponivel'] = $this->rendaDisponivel();
        $valores['deficit_ou_superavit'] = $this->deficitOuSuperavit();
        $valores['multiplicador_k_com_imposto'] = $this->multiplicadorKComImposto();
        $valores['multiplicador_k_sem_imposto'] = $this->multiplicadorKSemImposto();
        return $valores;
    }
}
