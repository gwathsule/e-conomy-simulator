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
 * @property float $taxa_base_de_juros
 * @property float $efmk
 * @property float $inflacao_de_demanda
 * @property float $inflacao_de_custo
 * @property float $inflacao_total
 * @property float $pmgc
 * @property float $imposto_renda
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
        return $this->titulos($ultimoAno) * $this->taxa_base_de_juros;
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
        if($this->taxa_base_de_juros > $this->efmk) {
            return 5 * ($this->taxa_base_de_juros - $this->efmk);
        } else {
            return 5 * ((-1) * ($this->efmk - $this->taxa_base_de_juros));
        }
    }

    private function desemprego(ResultadoAnual $ultimoAno){
        return $ultimoAno->desemprego * (($ultimoAno->pib/12)/$this->pib($ultimoAno));
    }
    private function k(ResultadoAnual $ultimoAno){
        return 1/(1-$ultimoAno->pmgc);
    }
    private function k_com_imposto(){
        return 1/(1-$this->pmgc) * (1 - $this->imposto_renda);
    }

    public function toArray()
    {
        /** @var ResultadoAnual $ultimoAno */
        $ultimoAno = $this->jogo->resultados_anuais->last();
        $ultimaRodada = null;
        if($this->rodada > 1){
            $ultimaRodada = $this->jogo->getRodada($this->rodada - 1)->toArray();
        }
        $valores = parent::toArray();
        $valores['pib'] = $this->pib($ultimoAno);
        $valores['previsao_anual'] = $this->previsao_anual($ultimoAno);
        $valores['yd'] = $this->yd($ultimoAno);
        $valores['pib_consumo'] = $this->pib_consumo($ultimoAno);
        $valores['pib_investimento_realizado'] = $this->pib_investimento_realizado($ultimoAno);
        $valores['impostos'] = $this->impostos($ultimoAno);
        $valores['bs'] = $this->bs($ultimoAno);
        $valores['titulos'] = $this->titulos($ultimoAno);
        $valores['juros_divida_interna'] = $this->juros_divida_interna($ultimoAno);
        $valores['caixa'] = $this->caixa($ultimoAno, $ultimaRodada);
        $valores['divida_total'] = $this->divida_total($ultimaRodada, $ultimoAno);
        $valores['investimento_em_titulos'] = $this->investimento_em_titulos($ultimoAno);
        $valores['desemprego'] = $this->desemprego($ultimoAno);
        $valores['k'] = $this->k($ultimoAno);
        $valores['k_com_imposto'] = $this->k_com_imposto();
        return $valores;
    }
}
