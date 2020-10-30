<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\RodadaRepository;
use App\Support\Evento;
use App\Domains\Evento\Noticias\FazerTransferenciaGeralNoticia;

/**
 * Deposita uma grana para a população equivalente ao valor economizado em impostos
 * Efeito imediato: aumento do PIB parcial por aquecer a economia
 * OBS: desenvolver ainda a projeção imediata a curto prazo do PIB.
 */
class FazerTransferenciaGeral extends Evento
{
    public const RODADAS = 0;
    public const CODE = 'fazer_transferencia_geral';

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
        $rodada->impostos -= $data['transferencia'];
        $rodada->transferencias += $data['transferencia'];

        (new RodadaRepository())->update($rodada);

        $dataNoticia = [
            'valor_transferencia' => $data['transferencia'],
            'imposto_atual' => $rodada->impostos,
            'transferencias_atual' => $rodada->transferencias,
        ];
        $noticia = new FazerTransferenciaGeralNoticia($dataNoticia);
        return $noticia->buidDataNoticia();
    }
}