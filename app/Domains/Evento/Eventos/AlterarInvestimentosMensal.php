<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Medida\Medida;
use App\Domains\Medida\MedidaRepository;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\RodadaRepository;
use App\Support\Evento;
use App\Support\Noticia;

class AlterarInvestimentosMensal extends Evento
{
    public const RODADAS = 1;
    public const CODE = 'alterar_invstimento_mensal';

    protected function getCode(): string
    {
        return self::CODE;
    }

    protected function getRodadas(): int
    {
        return self::RODADAS;
    }

    public function modificacoes(Rodada $rodada, Medida $medida): array
    {
        $rodada->investimentos_fixos += $medida->diferenca_financas;
        $rodada->popularidade_empresarios += $medida->diferenca_popularidade_empresarios;
        $rodada->popularidade_trabalhadores += $medida->diferenca_popularidade_trabalhadores;
        $rodada->popularidade_estado += $medida->diferenca_popularidade_estado;
        (new RodadaRepository())->update($rodada);
        $noticia = new Noticia($medida);
        return $noticia->buidDataNoticia();
    }
}