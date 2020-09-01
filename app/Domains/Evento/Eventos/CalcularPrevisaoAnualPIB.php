<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\EventoRepository;
use App\Domains\Evento\Noticias\PrevisaoAnualPibNoticia;
use App\Domains\Jogo\Jogo;
use App\Domains\Jogo\JogoRepository;
use App\Support\Evento;
use App\Domains\Evento\Evento as EventoModel;

class CalcularPrevisaoAnualPIB extends Evento
{
    public const RODADAS = 3;
    public const CODE = 'calcular_previsao_anual';

    public function modificacoes(Jogo $jogo, array $data): array
    {
        $variacao = config('jogo.pib.previsao_variacao');
        $modulo = config('jogo.pib.variacao_previsao_pib_modulo');
        $previsao = $variacao + ($this->aleatorio() * $modulo);
        $jogo->pib_prox_ano = $previsao;
        (new JogoRepository())->update($jogo);
        //cria um novo evento
        $novoEvento = new EventoModel();
        $novoEvento->jogo_id = $jogo->id;
        $novoEvento->rodadas_restantes = self::RODADAS;
        $novoEvento->code = self::CODE;
        $novoEvento->data = [];
        (new EventoRepository())->save($novoEvento);
        $noticia = new PrevisaoAnualPibNoticia([
            'aumento' => true,
            'previsao' => number_format (($previsao * 100), 2) . '%',
        ]);
        return $noticia->buidDataNoticia();
    }

    private function aleatorio() {
        return (0.1 + lcg_value()*(abs(0.99 - 0.1)));
    }

    protected function getCode(): string
    {
        return self::CODE;
    }

    protected function getRodadas(): int
    {
        return self::RODADAS;
    }
}