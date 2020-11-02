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
 * @property float $total_investimentos_anual montante anual dos investimentos
 * @property float $investimentos_mesal quantidade fixa de dinheiro de investimento que entra no PIB mensalmente
 * @property float $total_gastos_governamentais_anual montante anual dos gastos do governo
 * @property float $gastos_governamentais_mensal quantidade fixa de dinheiro que o governo gasta mensalmente
 * @property float $total_transferencias_anual
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
        return $this->total_investimentos_anual * ($this->multiplicadorKComImposto() - $this->multiplicadorKSemImposto());
    }

    public function consumo() : float
    {
        return ($this->total_investimentos_anual * $this->multiplicadorKComImposto()) - $this->total_investimentos_anual;
    }

    public function pib() : float
    {
        return $this->consumo() + $this->total_investimentos_anual + $this->total_gastos_governamentais_anual;
    }

    public function rendaDisponivel() : float
    {
        return $this->pib() + $this->total_gastos_governamentais_anual - $this->total_transferencias_anual;
    }

    public function deficitOuSuperavit(): float
    {
        return $this->total_gastos_governamentais_anual - $this->total_transferencias_anual - $this->impostos();
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
