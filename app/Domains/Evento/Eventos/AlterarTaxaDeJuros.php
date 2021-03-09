<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\Evento;
use App\Domains\Rodada\Rodada;
use App\Support\EventoService;
use App\Support\Exceptions\UserException;

class AlterarTaxaDeJuros extends EventoService
{
    public const CODE = 'alterar_taxa_de_juros';

    public function getCode(): string
    {
        return self::CODE;
    }

    //essa medida não cria eventos
    public function modificacoes(Rodada $rodada, Evento $evento)
    {
        $rodada->taxa_de_juros_base += $evento->data['valor_diferenca'];
        if($rodada->taxa_de_juros_base <= 0) {
            throw new UserException(__('user-messages.taxa-juros-menor-que-zero'));
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