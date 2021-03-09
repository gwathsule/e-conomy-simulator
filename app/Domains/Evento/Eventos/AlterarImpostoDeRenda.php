<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\Evento;
use App\Domains\Rodada\Rodada;
use App\Support\EventoService;
use App\Support\Exceptions\UserException;

class AlterarImpostoDeRenda extends EventoService
{
    public const CODE = 'alterar_imposto_de_renda';

    public function getCode(): string
    {
        return self::CODE;
    }

    //essa medida não cria eventos
    public function modificacoes(Rodada $rodada, Evento $evento)
    {
        $rodada->imposto_de_renda += $evento->data['valor_diferenca'];
        if($rodada->imposto_de_renda <= 0) {
            throw new UserException(__('user-messages.ir-menor-que-zero'));
        }
        $evento->rodadas_restantes--;
        if($evento->rodadas_restantes == 0) {
            $evento->delete();
        } else {
            $evento->update();
        }

    }

    public function buidData(float $valorDiferenca): array
    {
        return [
            'valor_diferenca' => $valorDiferenca
        ];
    }

}