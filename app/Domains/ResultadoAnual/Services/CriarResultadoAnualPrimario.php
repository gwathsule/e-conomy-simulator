<?php

namespace App\Domains\ResultadoAnual\Services;

use App\Domains\Jogo\Jogo;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\User\User;
use App\Support\Exceptions\UserException;
use App\Support\Service;
use App\Support\Validator;
use Illuminate\Support\Facades\Auth;

class CriarResultadoAnualPrimario extends Service
{
    public function validate(array $data)
    {
        /** @var Jogo $jogo */
        $jogo = Jogo::query()->find($data['jogo_id']);
        /** @var User $user */
        $user = Auth::user();
        if($jogo->user_id != $user->id) {
            throw new UserException(__('nao-autorizado'));
        }

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
        /** @var Jogo $jogo */
        $jogo = Jogo::query()->find($data['jogo_id']);
        $resultado = new ResultadoAnual();
        $resultado->ano = 0;
        $resultado->jogo_id = $jogo->id;
        $resultado->pib = 59224000.000;
        $resultado->previsao_anual = 0.030;
        $resultado->yd = 54492000.000;
        $resultado->pib_consumo = 39034000.000;
        $resultado->pib_investimento_potencial = 18000000.000;
        $resultado->pib_investimento_realizado = 16830000.000;
        $resultado->gastos_governamentais = 3360000.000;
        $resultado->transferencias = 2000000.000;
        $resultado->impostos = 6732000.000;
        $resultado->bs = 1372000.000;
        $resultado->titulos = 1170000.000;
        $resultado->juros_divida_interna = 105300.000;
        $caixaPrimaria = 350000.000;
        if($jogo->dificuldade === Jogo::DIFICULDADE_FACIL)
            $caixaPrimaria = 350000.000;
        if($jogo->dificuldade === Jogo::DIFICULDADE_NORMAL)
            $caixaPrimaria = 200000.000;
        if($jogo->dificuldade === Jogo::DIFICULDADE_DIFICIL)
            $caixaPrimaria = 96700.000;
        $resultado->caixa = $caixaPrimaria;
        $resultado->divida_total = 1275300.000;
        $resultado->taxa_de_juros_base = 0.090;
        $resultado->efmk = 0.077;
        $resultado->investimento_em_titulos = 0.065;
        $resultado->inflacao_total = 0.030;
        $resultado->inflacao_de_custo = 0.015;
        $resultado->inflacao_de_demanda = 0.015;
        $resultado->desemprego = 0.070;
        $resultado->pmgc = 0.700;
        $resultado->k = 3.333;
        $resultado->imposto_de_renda = 0.120;
        $resultado->k_com_imposto = 2.933;
        $popularidadePrimaria = 0.5;
        if($jogo->dificuldade === Jogo::DIFICULDADE_FACIL)
            $popularidadePrimaria = 1;
        if($jogo->dificuldade === Jogo::DIFICULDADE_NORMAL)
            $popularidadePrimaria = 0.5;
        if($jogo->dificuldade === Jogo::DIFICULDADE_DIFICIL)
            $popularidadePrimaria = 0.30;
        $resultado->popularidade_estado = $popularidadePrimaria;
        $resultado->popularidade_trabalhadores = $popularidadePrimaria;
        $resultado->popularidade_empresarios = $popularidadePrimaria;
        $resultado->save();
        return $resultado;
    }
}