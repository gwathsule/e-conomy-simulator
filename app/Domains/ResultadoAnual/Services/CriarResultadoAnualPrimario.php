<?php

namespace App\Domains\ResultadoAnual\Services;

use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Support\Service;
use App\Support\Validator;

class CriarResultadoAnualPrimario extends Service
{
    public function validate(array $data)
    {
        return (new class extends Validator {
            public function rules()
            {
                return [
                    'jogo_id' => ['int', 'required'],
                ];
            }
        })->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        $resultado = new ResultadoAnual();
        $resultado->ano = 0;
        $resultado->jogo_id = $data['jogo_id'];
        $resultado->pib = 59224000;
        $resultado->previsao_anual = 0.03;
        $resultado->yd = 54492000;
        $resultado->pib_consumo = 39034000;
        $resultado->pib_investimento_potencial = 18000000;
        $resultado->pib_investimento_realizado = 16830000;
        $resultado->gastos_governamentais = 3360000;
        $resultado->transferencias = 2000000;
        $resultado->impostos = 6732000;
        $resultado->bs = 1372000;
        $resultado->titulos = 1170000;
        $resultado->juros_divida_interna = 105300;
        $resultado->caixa = 96700;
        $resultado->divida_total = 1275300;
        $resultado->taxa_de_juros_base = 0.09;
        $resultado->efmk = 0.08;
        $resultado->investimento_em_titulos = 0.07;
        $resultado->inflacao_total = 0.03;
        $resultado->inflacao_de_custo = 0.02;
        $resultado->inflacao_de_demanda = 0.02;
        $resultado->desemprego = 0.07;
        $resultado->pmgc = 0.70;
        $resultado->k = 3.33;
        $resultado->imposto_de_renda = 0.12;
        $resultado->k_com_imposto = 2.93;
        $resultado->save();
        return $resultado;
    }
}