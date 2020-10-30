<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\EventoRepository;
use App\Domains\Evento\Noticias\CalcularPibAnualNoticia;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\RodadaRepository;
use App\Support\Evento;
use App\Domains\Evento\Evento as EventoModel;

class CalcularPibAnual extends Evento
{
    public const RODADAS = 12;
    public const CODE = 'calcular_pib_anual';

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
        $pibAntigo = $rodada->pib;
        $aumento = $rodada->pib_prox_ano * 100;
        $novoPib = $rodada->pib * ($rodada->pib_prox_ano + 1);
        $rodada->pib = $novoPib;
        (new RodadaRepository())->update($rodada);
        //cria um novo evento
        $novoEvento = new EventoModel();
        $novoEvento->jogo_id = $rodada->jogo_id;
        $novoEvento->rodadas_restantes = self::RODADAS;
        $novoEvento->code = self::CODE;
        $novoEvento->data = [];
        (new EventoRepository())->save($novoEvento);
        $dataNoticia = [
            'valor_antigo' => number_format($pibAntigo, 2, ',', ' '),
            'valor_novo' => number_format($novoPib, 2, ',', ' '),
            'porcentagem_aumento' => number_format($aumento, 2, ',', ' '),
            'aumentou' => $novoPib > $pibAntigo,
        ];
        $noticia = new CalcularPibAnualNoticia($dataNoticia);
        return $noticia->buidDataNoticia();
    }
}