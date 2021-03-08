<?php

namespace App\Domains\Evento;

use App\Domains\Evento\Eventos\AlterarImpostoDeRenda;
use App\Domains\Evento\Eventos\CriarTransferencia;
use App\Support\EventoService;
use App\Support\Repository;

class EventoRepository extends Repository
{
    public function getModel(): string
    {
        return Evento::class;
    }

    public function allEventos()
    {
        return [
            AlterarImpostoDeRenda::CODE => 'Alterar Imposto de Renda',
            CriarTransferencia::CODE => 'Criar Transferencias',
        ];
    }

    /**
     * @param string $code
     * @return EventoService
     */
    public function getService(string $code)
    {
        if(AlterarImpostoDeRenda::CODE) return new AlterarImpostoDeRenda;
        if(CriarTransferencia::CODE) return new CriarTransferencia;
    }
}