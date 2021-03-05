<?php

namespace App\Domains\ResultadoAnual\Services;

use App\Domains\Jogo\Jogo;
use App\Domains\ResultadoAnual\ResultadoAnual;
use App\Domains\Rodada\Rodada;
use App\Domains\User\User;
use App\Support\Exceptions\UserException;
use App\Support\Service;
use App\Support\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CriarResultadoAnual extends Service
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
                    'jogo_id' => ['int', 'required', 'between:1,2'],
                    'ano' => ['int', 'required']
                ];
            }
        })->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        /** @var Jogo $jogo */
        $jogo = Jogo::query()->find($data['jogo_id']);
        /** @var ResultadoAnual $ultimoAno */
        $ultimoAno = $jogo->resultados_anuais->last();
        if($data['ano'] == 1) {
            $rodadasAno = $this->informationToCollection($jogo->rodadas->slice(0, 12));
        } else {
            $rodadasAno = $this->informationToCollection($jogo->rodadas->slice(11));
        }
        $resultado = new ResultadoAnual();
        $resultado->ano = $data['ano'];
        $resultado->jogo_id = $jogo->id;
        $resultado->pib = $rodadasAno->sum('pib');
        $resultado->transferencias = $rodadasAno->sum('transferencias');
        $resultado->impostos = $rodadasAno->sum('impostos');
        $resultado->yd = $resultado->pib - $resultado->impostos + $resultado->transferencias;
        $resultado->pib_consumo = $rodadasAno->sum('pib_consumo');
        $resultado->pib_investimento_potencial = $rodadasAno->sum('pib_investimento_potencial');
        $resultado->pib_investimento_realizado = $rodadasAno->sum('pib_investimento_realizado');
        $resultado->gastos_governamentais = $rodadasAno->sum('gastos_governamentais');
        $resultado->bs = $rodadasAno->sum('bs');
        $resultado->titulos = $rodadasAno->sum('titulos');
        $resultado->juros_divida_interna = $rodadasAno->sum('juros_divida_interna');
        $resultado->caixa = $rodadasAno->last()['caixa'] - $rodadasAno->last()['divida_total'];
        $resultado->divida_total = $rodadasAno->last()['divida_total'];
        $resultado->taxa_de_juros_base = $rodadasAno->last()['taxa_de_juros_base'];
        $resultado->efmk = $rodadasAno->last()['efmk'];
        $resultado->investimento_em_titulos = $rodadasAno->last()['investimento_em_titulos'];
        $resultado->inflacao_total = $rodadasAno->avg('inflacao_total');
        $resultado->inflacao_de_custo = $rodadasAno->avg('inflacao_de_custo');
        $resultado->inflacao_de_demanda = $rodadasAno->avg('inflacao_de_demanda');
        $resultado->desemprego = $rodadasAno->last()['desemprego'];
        $resultado->pmgc = $rodadasAno->last()['pmgc'];
        $resultado->k = 1/(1-$ultimoAno->pmgc);
        $resultado->imposto_de_renda = $rodadasAno->last()['imposto_de_renda'];
        $resultado->k_com_imposto = 1/(1-$resultado->pmgc) * (1 - $resultado->imposto_de_renda);
        $resultado->save();
        return $resultado;
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    private function informationToCollection(Collection $collection)
    {
        return $collection->reduce(function (Collection $carry, Rodada $item) {
            $info = $item->toInformation();
            return $carry->add($info);
        }, collect());
    }
}