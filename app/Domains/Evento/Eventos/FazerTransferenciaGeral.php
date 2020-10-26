<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
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

    public function modificacoes(Jogo $jogo, array $data): array
    {
        $jogo->impostos -= $data['transferencia'];
        $jogo->transferencias += $data['transferencia'];

        (new JogoRepository())->update($jogo);

        $dataNoticia = [
            'valor_transferencia' => $data['transferencia'],
            'imposto_atual' => $jogo->impostos,
            'transferencias_atual' => $jogo->transferencias,
        ];
        $noticia = new FazerTransferenciaGeralNoticia($dataNoticia);
        return $noticia->buidDataNoticia();
    }
}