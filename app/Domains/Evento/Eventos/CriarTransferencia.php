<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\Evento;
use App\Domains\Rodada\Rodada;
use App\Support\EventoService;

class CriarTransferencia extends EventoService
{
    public const CODE = 'criar_transferencia';

    public function getCode(): string
    {
        return self::CODE;
    }

    //essa medida cria um evento que vai rodar até o fim do ano corrente
    public function modificacoes(Rodada $rodada, Evento $evento): array
    {
        $rodada->transferencias += $evento->data['valor_diferenca'];
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