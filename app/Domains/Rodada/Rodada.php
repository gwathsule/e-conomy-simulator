<?php

namespace App\Domains\Rodada;

use App\Domains\Jogo\Jogo;
use App\Domains\ResultadoAnual\ResultadoAnual;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $rodada
 * @property float $pib_investimento_potencial
 * @property float $gastos_governamentais
 * @property float $transferencias
 * @property float $taxa_de_juros_base
 * @property float $efmk
 * @property float $inflacao_de_demanda
 * @property float $inflacao_de_custo
 * @property float $inflacao_total
 * @property float $pmgc
 * @property float $imposto_de_renda
 * @property float $popularidade_empresarios
 * @property float $popularidade_trabalhadores
 * @property float $popularidade_estado
 * @property int $medida_id
 * @property array $noticias
 * @property Jogo $jogo
 */
class Rodada extends Model
{
    protected $table = 'rodada';

    protected $casts = [
        'noticias' => 'array',
    ];

    public function jogo(){
        return $this->belongsTo(Jogo::class);
    }
    private function pib($ultimoAno){
        return $this->pib_consumo($ultimoAno) + $this->pib_investimento_realizado($ultimoAno) + $this->gastos_governamentais;
    }
    private function previsao_anual(ResultadoAnual $ultimoAno){
        return $ultimoAno->previsao_anual;
    }
    private function yd($ultimoAno){
        return $this->pib($ultimoAno) - $this->impostos($ultimoAno) + $this->transferencias;
    }
    private function pib_consumo($ultimoAno){
        return ($this->pib_investimento_realizado($ultimoAno) * $this->k_com_imposto()) - $this->pib_investimento_realizado($ultimoAno) +
               ($this->gastos_governamentais * $this->k_com_imposto()) - $this->gastos_governamentais;
    }
    private function pib_investimento_realizado($ultimoAno){
        return $this->pib_investimento_potencial * (1 - $this->investimento_em_titulos($ultimoAno));
    }
    private function impostos($ultimoAno){
        return $this->pib_investimento_realizado($ultimoAno) * ($this->k($ultimoAno) - $this->k_com_imposto());
    }
    private function bs($ultimoAno){
        return $this->impostos($ultimoAno) - $this->gastos_governamentais - $this->transferencias;
    }
    private function titulos($ultimoAno){
        return $this->pib_investimento_potencial - $this->pib_investimento_realizado($ultimoAno);
    }
    private function juros_divida_interna($ultimoAno){
        return $this->titulos($ultimoAno) * $this->taxa_de_juros_base;
    }
    private function caixa($ultimoAno, $ultimaRodada){
        if($this->rodada == 1){
            return $ultimoAno->caixa + $this->bs($ultimoAno);
        }
        return $ultimaRodada['caixa'] + $this->bs($ultimoAno);
    }
    private function divida_total($ultimaRodada, $ultimoAno){
        if($this->rodada == 1) {
            return $this->titulos($ultimoAno) + $this->juros_divida_interna($ultimoAno);
        } else {
            return $ultimaRodada['divida_total'] + $this->titulos($ultimoAno) + $this->juros_divida_interna($ultimoAno);
        }
    }
    private function investimento_em_titulos(ResultadoAnual $ultimoAno){
        if($this->taxa_de_juros_base > $this->efmk) {
            return 5 * ($this->taxa_de_juros_base - $this->efmk);
        } else {
            return 5 * ((-1) * ($this->efmk - $this->taxa_de_juros_base));
        }
    }

    private function desemprego(ResultadoAnual $ultimoAno){
        return $ultimoAno->desemprego * (($ultimoAno->pib/12)/$this->pib($ultimoAno));
    }
    private function k(ResultadoAnual $ultimoAno){
        return 1/(1-$ultimoAno->pmgc);
    }
    private function k_com_imposto(){
        return 1/(1-$this->pmgc) * (1 - $this->imposto_de_renda);
    }

    public function toInformation()
    {
        /** @var ResultadoAnual $ultimoAno */
        $ultimoAno = $this->jogo->resultados_anuais->last();
        $ultimaRodada = null;
        if($this->rodada > 1){
            $ultimaRodada = $this->jogo->getRodada($this->rodada - 1)->toInformation();
        }
        $valores = parent::attributesToArray();
        $valores['pib'] = number_format($this->pib($ultimoAno), 2, '.', '');
        $valores['previsao_anual'] = number_format($this->previsao_anual($ultimoAno), 2, '.', '');
        $valores['yd'] = number_format($this->yd($ultimoAno), 2, '.', '');
        $valores['pib_consumo'] = number_format($this->pib_consumo($ultimoAno), 2, '.', '');
        $valores['pib_investimento_realizado'] = number_format($this->pib_investimento_realizado($ultimoAno), 2, '.', '');
        $valores['impostos'] = number_format($this->impostos($ultimoAno), 2, '.', '');
        $valores['bs'] = number_format($this->bs($ultimoAno), 2, '.', '');
        $valores['titulos'] = number_format($this->titulos($ultimoAno), 2, '.', '');
        $valores['juros_divida_interna'] = number_format($this->juros_divida_interna($ultimoAno), 2, '.', '');
        $valores['caixa'] = number_format($this->caixa($ultimoAno, $ultimaRodada), 2, '.', '');
        $valores['divida_total'] = number_format($this->divida_total($ultimaRodada, $ultimoAno), 2, '.', '');
        $valores['investimento_em_titulos'] = number_format($this->investimento_em_titulos($ultimoAno), 2, '.', '');
        $valores['desemprego'] = number_format($this->desemprego($ultimoAno), 2, '.', '');
        $valores['k'] = number_format($this->k($ultimoAno), 2, '.', '');
        $valores['k_com_imposto'] = number_format($this->k_com_imposto(), 2, '.', '');
        return $valores;
    }
}
