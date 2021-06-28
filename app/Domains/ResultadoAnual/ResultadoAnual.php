<?php

namespace App\Domains\ResultadoAnual;

use App\Domains\Jogo\Jogo;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $jogo_id
 * @property int $ano
 * @property float $pib
 * @property float $previsao_anual
 * @property float $yd
 * @property float $pib_consumo
 * @property float $pib_investimento_potencial
 * @property float $pib_investimento_realizado
 * @property float $gastos_governamentais
 * @property float $transferencias
 * @property float $impostos
 * @property float $bs
 * @property float $titulos
 * @property float $juros_divida_interna
 * @property float $caixa
 * @property float $divida_total
 * @property float $taxa_de_juros_base
 * @property float $efmk
 * @property float $investimento_em_titulos
 * @property float $inflacao_total
 * @property float $inflacao_de_custo
 * @property float $inflacao_de_demanda
 * @property float $desemprego
 * @property float $pmgc
 * @property float $k
 * @property float $imposto_de_renda
 * @property float $k_com_imposto
 * @property float $popularidade_empresarios
 * @property float $popularidade_trabalhadores
 * @property float $popularidade_estado
 * @property Jogo $jogo
 */
class ResultadoAnual extends Model
{
    use AnalisesResultados;

    protected $table = 'resultado_anual';
    public $timestamps = false;

    public function jogo()
    {
        return $this->belongsTo(Jogo::class);
    }

    public function criarAnaliseAnual(int $ano)
    {
        $anoAtual = $this;
        $anoAnterior = $this->jogo->getAno($this->ano - 1);
        if(is_null($anoAnterior)) {
            throw new \Exception("ano anterior ao ano ".$this->ano." é nulo");
        }
        return [
            'pib' => $this->analisePib($ano, $anoAtual,$anoAnterior),
            'pib_investimento_realizado' => $this->analisePibInvestimentoRealizado($ano, $anoAtual, $anoAnterior),
            'gastos_governamentais' => $this->analiseGastosGovernamentais($ano, $anoAtual, $anoAnterior),
            'transferencias' => $this->analiseTransferencias($ano, $anoAtual, $anoAnterior),
            'impostos' => $this->analiseImpostos($ano, $anoAtual, $anoAnterior),
            'bs' => $this->analiseBs($ano, $anoAtual, $anoAnterior),
            'caixa' => $this->analiseCaixa($ano, $anoAtual, $anoAnterior),
            'divida_total' => $this->analiseDividaTotal($ano, $anoAtual, $anoAnterior),
            'inflacao_total' => $this->analiseInflacaoTotal($ano, $anoAtual, $anoAnterior),
            'desemprego' => $this->analiseDesemprego($ano, $anoAtual, $anoAnterior),
            'popularidade_empresarios' => $this->analisePopularidadeEmpresarios($ano, $anoAtual, $anoAnterior),
            'popularidade_trabalhadores' => $this->analisePopularidadeTrabalhadores($ano, $anoAtual, $anoAnterior),
            'popularidade_estado' => $this->analisePopularidadeEstado($ano, $anoAtual, $anoAnterior),
        ];
    }
}