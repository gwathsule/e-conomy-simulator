<?php

namespace App\Domains\Rodada\Services;

use App\Domains\Evento\Eventos\AlterarTransferencia;
use App\Domains\Medida\Medida;
use App\Domains\Medida\MedidaRepository;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\Rodada\Rodada;
use Exception;

class CalcularResultantes
{
    /**
     * @var Rodada
     */
    private $rodadaAtual;
    /**
     * @var Rodada|null
     */
    private $ultimaRodada;
    /**
     * @var ResultadoAnual
     */
    private $ultimoAno;
    /**
     * @var string|null
     */
    private $codeEventoMedidaAtual;

    public function __construct(
        Rodada $rodadaAtual,
        ResultadoAnual $ultimoAno,
        string $codeEventoMedidaAtual,
        Rodada $ultimaRodada = null
    )
    {
        $this->rodadaAtual = $rodadaAtual;
        $this->ultimoAno = $ultimoAno;
        $this->codeEventoMedidaAtual = $codeEventoMedidaAtual;
        $this->ultimaRodada = $ultimaRodada;
    }

    /**
     * Calcula as resultantes da rodada
     * @return Rodada
     * @throws Exception
     */
    public function perform()
    {
        $this->validarAntesDeCalular();
        $this->rodadaAtual->pmgc = $this->pmgc();
        $this->rodadaAtual->k = $this->k();
        $this->rodadaAtual->k_com_imposto = $this->k_com_imposto();
        $this->rodadaAtual->efmk = $this->efmk();
        $this->rodadaAtual->investimento_em_titulos = $this->investimento_em_titulos();
        $this->rodadaAtual->pib_investimento_realizado = $this->pib_investimento_realizado();
        $this->rodadaAtual->pib_consumo = $this->pib_consumo();
        $this->rodadaAtual->pib = $this->pib();
        $this->rodadaAtual->impostos = $this->impostos();
        $this->rodadaAtual->previsao_anual = $this->previsao_anual();
        $this->rodadaAtual->yd = $this->yd();
        $this->rodadaAtual->bs = $this->bs();
        $this->rodadaAtual->titulos = $this->titulos();
        $this->rodadaAtual->juros_divida_interna = $this->juros_divida_interna();
        $this->rodadaAtual->caixa = $this->caixa();
        $this->rodadaAtual->divida_total = $this->divida_total();
        $this->rodadaAtual->desemprego = $this->desemprego();
        $this->rodadaAtual->inflacao_de_demanda = $this->inflacao_de_demanda();
        $this->rodadaAtual->inflacao_de_custo = $this->inflacao_de_custo();
        $this->rodadaAtual->inflacao_total = $this->inflacao_total();
        return $this->rodadaAtual;
    }

    private function inflacao_de_demanda()
    {
        if(is_null($this->ultimaRodada)) {
            return $this->formatarPorcentagem($this->ultimoAno->inflacao_de_demanda);
        }
        if(is_null($this->rodadaAtual->pib_investimento_realizado))
            throw new Exception('impossivel calcular inflacao_de_demanda: pib_investimento_realizado nulo');
        if(is_null($this->rodadaAtual->transferencias))
            throw new Exception('impossivel calcular inflacao_de_demanda: transferencias nulo');
        $valorMedioNormal = $this->formatarValorMonetario(($this->ultimoAno->pib_investimento_realizado / 12));
        $investimentoMudouDesdeAUltimaRodada = $this->ultimaRodada->pib_investimento_realizado != $this->rodadaAtual->pib_investimento_realizado;
        $investimentoMedioMudou = $valorMedioNormal != $this->rodadaAtual->pib_investimento_realizado;
        $investimentoMudou = $investimentoMudouDesdeAUltimaRodada && $investimentoMedioMudou;
        if($investimentoMudou || $this->codeEventoMedidaAtual == AlterarTransferencia::CODE) {
            $valor = (((($this->ultimoAno->pib_investimento_realizado-$this->rodadaAtual->pib_investimento_realizado*12)/$this->rodadaAtual->pib_investimento_realizado)/12) -
                     ((($this->ultimoAno->transferencias-($this->rodadaAtual->transferencias*12))/$this->ultimoAno->transferencias)/12)) +
                     0.015;
            return $this->formatarPorcentagem($valor);
        }
        return 0.015;
    }

    private function inflacao_de_custo()
    {
        if(is_null($this->rodadaAtual->imposto_de_renda))
            throw new Exception('impossivel calcular inflacao_de_custo: imposto_de_renda nulo');
        if(is_null($this->ultimaRodada)) {
            return $this->formatarPorcentagem($this->ultimoAno->inflacao_de_custo);
        }
        $valor = (($this->ultimaRodada->imposto_de_renda - $this->rodadaAtual->imposto_de_renda) * (-1))+0.015;
        return $this->formatarPorcentagem($valor);
    }

    private function inflacao_total()
    {
        if(is_null($this->rodadaAtual->inflacao_de_custo))
            throw new Exception('impossivel calcular inflacao_total: inflacao_de_custo nulo');
        if(is_null($this->rodadaAtual->inflacao_de_demanda))
            throw new Exception('impossivel calcular inflacao_total: inflacao_de_demanda nulo');
        $valor = $this->rodadaAtual->inflacao_de_custo + $this->rodadaAtual->inflacao_de_demanda;
        return $this->formatarPorcentagem($valor);
    }

    private function pib(){
        if(is_null($this->rodadaAtual->pib_consumo))
            throw new Exception('impossivel calcular pib: pib_consumo nulo');
        if(is_null($this->rodadaAtual->pib_investimento_realizado))
            throw new Exception('impossivel calcular pib: pib_investimento_realizado nulo');
        if(is_null($this->rodadaAtual->gastos_governamentais))
            throw new Exception('impossivel calcular pib: gastos_governamentais nulo');

        $valor = $this->rodadaAtual->pib_consumo +
                 $this->rodadaAtual->pib_investimento_realizado +
                 $this->rodadaAtual->gastos_governamentais;
        return $this->formatarValorMonetario($valor);
    }

    private function previsao_anual(){
        if(is_null($this->rodadaAtual->pib_investimento_realizado))
            throw new Exception('impossivel calcular previsao_anual: ultimoAno->previsao_anual nulo');
        return $this->formatarPorcentagem($this->ultimoAno->previsao_anual);
    }

    private function yd(){
        if(is_null($this->rodadaAtual->pib))
            throw new Exception('impossivel calcular yd: pib nulo');
        if(is_null($this->rodadaAtual->impostos))
            throw new Exception('impossivel calcular yd: impostos nulo');
        if(is_null($this->rodadaAtual->transferencias))
            throw new Exception('impossivel calcular yd: transferencias nulo');

        $valor= $this->rodadaAtual->pib -
                $this->rodadaAtual->impostos +
                $this->rodadaAtual->transferencias;

        return $this->formatarValorMonetario($valor);
    }

    private function pib_consumo(){
        if(is_null($this->rodadaAtual->pib_investimento_realizado))
            throw new Exception('impossivel calcular pib_consumo: pib_investimento_realizado nulo');
        if(is_null($this->rodadaAtual->k_com_imposto))
            throw new Exception('impossivel calcular pib_consumo: k_com_imposto nulo');
        if(is_null($this->rodadaAtual->gastos_governamentais))
            throw new Exception('impossivel calcular pib_consumo: gastos_governamentais nulo');
        $c10 = $this->rodadaAtual->pib_investimento_realizado;
        $c38 = $this->rodadaAtual->k_com_imposto;
        $c11 = (float) $this->rodadaAtual->gastos_governamentais;
        $valor = ($c10*$c38)-$c10+($c11*$c38)-$c11;
        return $this->formatarValorMonetario($valor);
    }

    private function pib_investimento_realizado(){
        if(is_null($this->rodadaAtual->pib_investimento_potencial))
            throw new Exception('impossivel calcular pib_investimento_realizado: pib_investimento_potencial nulo');
        if(is_null($this->rodadaAtual->investimento_em_titulos))
            throw new Exception('impossivel calcular pib_investimento_realizado: investimento_em_titulos nulo');
        $valor = $this->rodadaAtual->pib_investimento_potencial * (1 - $this->rodadaAtual->investimento_em_titulos);
        return $this->formatarValorMonetario($valor);
    }

    private function impostos(){
        if(is_null($this->rodadaAtual->pib_investimento_realizado))
            throw new Exception('impossivel calcular impostos: pib_investimento_realizado nulo');
        if(is_null($this->rodadaAtual->k))
            throw new Exception('impossivel calcular impostos: k nulo');
        if(is_null($this->rodadaAtual->k_com_imposto))
            throw new Exception('impossivel calcular impostos: k_com_imposto nulo');

        $valor = $this->rodadaAtual->pib_investimento_realizado *
            ($this->rodadaAtual->k - $this->rodadaAtual->k_com_imposto);
        return $this->formatarValorMonetario($valor);
    }



    private function bs(){
        if(is_null($this->rodadaAtual->impostos))
            throw new Exception('impossivel calcular BS: impostos nulo');
        if(is_null($this->rodadaAtual->gastos_governamentais))
            throw new Exception('impossivel calcular BS: gastos_governamentais nulo');
        if(is_null($this->rodadaAtual->transferencias))
            throw new Exception('impossivel calcular BS: transferencias nulo');

        $valor = $this->rodadaAtual->impostos -
                 $this->rodadaAtual->gastos_governamentais -
                 $this->rodadaAtual->transferencias;

        return $this->formatarValorMonetario($valor);
    }

    private function titulos(){
        if(is_null($this->rodadaAtual->pib_investimento_potencial))
            throw new Exception('impossivel calcular titulos: pib_investimento_potencial nulo');
        if(is_null($this->rodadaAtual->pib_investimento_realizado))
            throw new Exception('impossivel calcular titulos: pib_investimento_realizado nulo');
        $valor = $this->rodadaAtual->pib_investimento_potencial -
                 $this->rodadaAtual->pib_investimento_realizado;
        return $this->formatarValorMonetario($valor);
    }

    private function juros_divida_interna(){
        if(is_null($this->rodadaAtual->titulos))
            throw new Exception('impossivel calcular juros_divida_interna: titulos nulo');
        if(is_null($this->rodadaAtual->taxa_de_juros_base))
            throw new Exception('impossivel calcular juros_divida_interna: taxa_de_juros_base nulo');
        $valor = $this->rodadaAtual->titulos *
                 $this->rodadaAtual->taxa_de_juros_base;
        return $this->formatarValorMonetario($valor);
    }

    private function efmk() {
        if(is_null($this->ultimaRodada)) {
            return $this->formatarPorcentagem($this->ultimoAno->efmk);
        }
        if($this->codeEventoMedidaAtual == AlterarTransferencia::CODE) {
            if(is_null($this->rodadaAtual->transferencias))
                throw new Exception('impossivel calcular efmk: transferencias nulo');
            /** @var Medida $medida */
            $medida = (new MedidaRepository())->getById($this->rodadaAtual->medida_id);
            $valor = (($this->ultimoAno->transferencias + $medida->diferenca_financas)/1000000000) + 0.075;
            return $this->formatarPorcentagem($valor);
        }
        return $this->formatarPorcentagem($this->ultimaRodada->efmk);
    }

    private function caixa(){
        if(is_null($this->rodadaAtual->bs))
            throw new Exception('impossivel calcular caixa: bs nulo');
        if(is_null($this->ultimaRodada)){
            $valor = $this->ultimoAno->caixa + $this->rodadaAtual->bs;
            return $this->formatarValorMonetario($valor);
        }
        $valor = $this->ultimaRodada->caixa + $this->rodadaAtual->bs;
        return $this->formatarValorMonetario($valor);
    }

    private function divida_total(){
        if(is_null($this->rodadaAtual->titulos))
            throw new Exception('impossivel calcular divida_total: titulos nulo');
        if(is_null($this->rodadaAtual->juros_divida_interna))
            throw new Exception('impossivel calcular divida_total: juros_divida_interna nulo');
        if(is_null($this->ultimaRodada)) {
            $valor = $this->rodadaAtual->titulos + $this->rodadaAtual->juros_divida_interna;
            return $this->formatarValorMonetario($valor);
        } else {
            $valor = $this->ultimaRodada->divida_total +
                     $this->rodadaAtual->titulos +
                     $this->rodadaAtual->juros_divida_interna;
            return $this->formatarValorMonetario($valor);
        }
    }

    private function investimento_em_titulos(){
        if(is_null($this->rodadaAtual->taxa_de_juros_base))
            throw new Exception('impossivel calcular investimento_em_titulos: taxa_de_juros_base nulo');
        if(is_null($this->rodadaAtual->efmk))
            throw new Exception('impossivel calcular investimento_em_titulos: efmk nulo');

        if($this->rodadaAtual->taxa_de_juros_base - $this->rodadaAtual->efmk > 0) {
            $valor = 5 * ($this->rodadaAtual->taxa_de_juros_base - $this->rodadaAtual->efmk);
            return $this->formatarPorcentagem($valor);
        } else {
            return 0;
        }
    }

    private function desemprego(){
        if(is_null($this->rodadaAtual->pib))
            throw new Exception('impossivel calcular desemprego: pib nulo');
        $valor = $this->ultimoAno->desemprego * (($this->ultimoAno->pib/12)/$this->rodadaAtual->pib);
        return $this->formatarPorcentagem($valor);
    }

    private function k(){
        $valor = 1/(1-$this->ultimoAno->pmgc);
        return round($valor, 2);
    }

    private function k_com_imposto(){
        if(is_null($this->rodadaAtual->imposto_de_renda))
            throw new Exception('impossivel calcular k com imposto: imposto de renda nulo');
        $valor = 1/(1-$this->rodadaAtual->pmgc) * (1 - $this->rodadaAtual->imposto_de_renda);
        return round($valor, 2);
    }

    private function pmgc(){
        if(is_null($this->ultimaRodada)) {
            return round($this->ultimoAno->pmgc, 2);
        }
        return round($this->ultimaRodada->pmgc, 2);
    }

    private function formatarPorcentagem(float $porcentagem) {
        if($porcentagem > 1 || $porcentagem < -1) {
            throw new Exception('tentando formar um número que não é uma porcentagem');
        }
        return round($porcentagem, 4);
    }

    private function formatarValorMonetario(float $valor) {
        return round($valor, 2);
    }

    private function validarAntesDeCalular()
    {
        if(! is_null($this->rodadaAtual->pib)) throw new Exception('variável pib calculada antes da hora');
        if(! is_null($this->rodadaAtual->previsao_anual)) throw new Exception('variável previsao_anual calculada antes da hora');
        if(! is_null($this->rodadaAtual->yd)) throw new Exception('variável yd calculada antes da hora');
        if(! is_null($this->rodadaAtual->pib_consumo)) throw new Exception('variável pib_consumo calculada antes da hora');
        if(! is_null($this->rodadaAtual->pib_investimento_realizado)) throw new Exception('variável pib_investimento_realizado calculada antes da hora');
        if(! is_null($this->rodadaAtual->impostos)) throw new Exception('variável impostos calculada antes da hora');
        if(! is_null($this->rodadaAtual->bs)) throw new Exception('variável bs calculada antes da hora');
        if(! is_null($this->rodadaAtual->efmk)) throw new Exception('variável efmk calculada antes da hora');
        if(! is_null($this->rodadaAtual->titulos)) throw new Exception('variável titulos calculada antes da hora');
        if(! is_null($this->rodadaAtual->juros_divida_interna)) throw new Exception('variável juros_divida_interna calculada antes da hora');
        if(! is_null($this->rodadaAtual->caixa)) throw new Exception('variável caixa calculada antes da hora');
        if(! is_null($this->rodadaAtual->divida_total)) throw new Exception('variável divida_total calculada antes da hora');
        if(! is_null($this->rodadaAtual->investimento_em_titulos)) throw new Exception('variável investimento_em_titulos calculada antes da hora');
        if(! is_null($this->rodadaAtual->desemprego)) throw new Exception('variável desemprego calculada antes da hora');
        if(! is_null($this->rodadaAtual->k)) throw new Exception('variável k calculada antes da hora');
        if(! is_null($this->rodadaAtual->k_com_imposto)) throw new Exception('variável k_com_imposto calculada antes da hora');
        if(! is_null($this->rodadaAtual->inflacao_de_demanda)) throw new Exception('variável inflacao_de_demanda calculada antes da hora');
        if(! is_null($this->rodadaAtual->inflacao_de_custo)) throw new Exception('variável inflacao_de_custo calculada antes da hora');
        if(! is_null($this->rodadaAtual->inflacao_total)) throw new Exception('variável inflacao_total calculada antes da hora');
    }

}