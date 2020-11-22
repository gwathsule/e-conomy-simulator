<?php

namespace App\Domains\Evento;

use App\Domains\Evento\Eventos\AlterarGastoGovernamental;
use App\Domains\Evento\Eventos\AlterarGastoGovernamentalMensal;
use App\Domains\Evento\Eventos\AlterarImpostoDeRenda;
use App\Domains\Evento\Eventos\AlterarInvestimentos;
use App\Domains\Evento\Eventos\AlterarInvestimentosMensal;
use App\Domains\Evento\Eventos\CriarTransferencia;
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
            AlterarGastoGovernamental::CODE => 'Alterar Gastos Governamentais',
            AlterarGastoGovernamentalMensal::CODE => 'Alterar Gastos Governamentais Fixos',
            AlterarImpostoDeRenda::CODE => 'Alterar Imposto de Renda',
            AlterarInvestimentos::CODE => 'Alterar Investimentos',
            AlterarInvestimentosMensal::CODE => 'Alterar Investimentos Fixos',
            CriarTransferencia::CODE => 'Criar Transferencias',
        ];
    }
}