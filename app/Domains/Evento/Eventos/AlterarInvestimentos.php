<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Medida\Medida;
use App\Domains\Medida\MedidaRepository;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\RodadaRepository;
use App\Support\Evento;
use App\Support\Noticia;

class AlterarInvestimentos extends Evento
{
    public const RODADAS = 1;
    public const CODE = 'alterar_investimentos';

    protected function getCode(): string
    {
        return self::CODE;
    }

    protected function getRodadas(): int
    {
        return self::RODADAS;
    }

    public function modificacoes(Rodada $rodada, array $data): array
    {
        /** @var Medida $medida */
        $medida = (new MedidaRepository())->getById($data['medida_id']);
        $rodada->investimentos += $medida->diferenca;
        (new RodadaRepository())->update($rodada);
        $noticia = new Noticia($medida);
        return $noticia->buidDataNoticia();
    }
}