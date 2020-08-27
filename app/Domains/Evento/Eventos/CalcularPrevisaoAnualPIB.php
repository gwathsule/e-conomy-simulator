<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\Noticias\PrevisaoAnualPibNoticia;
use App\Domains\Jogo\Jogo;
use App\Support\Evento;
use App\Support\Noticia;

class CalcularPrevisaoAnualPIB extends Evento
{
    private const CODE = 'calcular_previsao_anual';

    protected function getCode(): string
    {
        return self::CODE;
    }

    protected function modificacoes(Jogo $jogo, array $data): Noticia
    {
        $variacao = config('jogo.pib.previsao_variacao');
        $modulo = config('jogo.pib.variacao_previsao_pib_modulo');
        $previsao = $variacao + ($this->aleatorio() * $modulo);
        $noticia = new PrevisaoAnualPibNoticia([
            'aumento' => true,
            'previsao' => number_format (($previsao * 100), 2) . '%',
        ]);
        return $noticia;
    }

    private function aleatorio() {
        return (0.1 + lcg_value()*(abs(0.99 - 0.1)));
    }
}