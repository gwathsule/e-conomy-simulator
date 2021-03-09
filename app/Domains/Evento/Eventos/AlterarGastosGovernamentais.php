<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\Evento;
use App\Domains\Rodada\Rodada;
use App\Support\EventoService;
use App\Support\Exceptions\UserException;

class AlterarGastosGovernamentais extends EventoService
{
    public const CODE = 'alterar_imposto_de_renda';

    public function getCode(): string
    {
        return self::CODE;
    }

    //essa medida cria um evento que vai rodar até o fim do ano corrente
    public function modificacoes(Rodada $rodada, Evento $evento)
    {
        $rodada->gastos_governamentais += $evento->data['valor_diferenca'];
        if($rodada->gastos_governamentais <= 0) {
            throw new UserException(__('user-messages.gastos-governamentais-menor-que-zero'));
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