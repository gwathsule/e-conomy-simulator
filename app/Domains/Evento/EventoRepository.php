<?php

namespace App\Domains\Evento;

use App\Domains\Evento\Eventos\AlterarGastosGovernamentais;
use App\Domains\Evento\Eventos\AlterarImpostoDeRenda;
use App\Domains\Evento\Eventos\AlterarTaxaDeJuros;
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
            AlterarGastosGovernamentais::CODE => 'Alterar Gastos Governamentais',
            AlterarTaxaDeJuros::CODE => 'Alterar Taxa de Juros',
        ];
    }

    /**
     * @param string $code
     * @return EventoService
     */
    public function getService(string $code)
    {
        if($code == AlterarImpostoDeRenda::CODE) return new AlterarImpostoDeRenda;
        if($code == CriarTransferencia::CODE) return new CriarTransferencia;
        if($code == AlterarGastosGovernamentais::CODE) return new AlterarGastosGovernamentais;
        if($code == AlterarTaxaDeJuros::CODE) return new AlterarTaxaDeJuros;
    }
}