<?php

namespace App\Domains\Evento\Eventos;

use App\Domains\Evento\EventoRepository;
use App\Domains\Evento\Noticias\PrevisaoAnualPibNoticia;
use App\Domains\Rodada\Rodada;
use App\Domains\Rodada\RodadaRepository;
use App\Support\Evento;
use App\Domains\Evento\Evento as EventoModel;

class CalcularPrevisaoAnualPIB extends Evento
{
    public const RODADAS = 3;
    public const CODE = 'calcular_previsao_anual';
    private const PIB_MODULO_VARIACAO = 0.01; //módulo (x2) da margem de variação do PIB (0,5%)
    private const PIB_PREVISAO_VARIACAO = 0.025; //previsão de 3% subtraindo variação (resultando em 2,5%)

    public function modificacoes(Rodada $rodada, array $data): array
    {
        $previsao = self::PIB_PREVISAO_VARIACAO + ($this->aleatorioZeroAUm() * self::PIB_MODULO_VARIACAO);
        $rodada->pib_previsao_anual = $previsao;
        (new RodadaRepository())->update($rodada);
        //cria um novo evento
        $novoEvento = new EventoModel();
        $novoEvento->jogo_id = $rodada->jogo_id;
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

    private function aleatorioZeroAUm() {
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