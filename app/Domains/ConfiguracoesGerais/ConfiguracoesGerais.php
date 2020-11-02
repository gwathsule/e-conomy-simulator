<?php

namespace App\Domains\ConfiguracoesGerais;

class ConfiguracoesGerais
{
    //configuracoes jogo
    public const QTD_RODADAS = 24;

    //valores iniciais padrão
    public const POPULACAO_INICIAL = 100000;
    public const PIB_PER_CAPITA_INICIAL = 1200;
    public const PIB_PREVISAO_ANUAL_INICIAL = 0.03;
    public const PMGC_INICIAL = 0.7;
    public const IMPOSTO_DE_RENDA_INICIAL= 0.2;
    public const PIB_INICIAL = self::POPULACAO_INICIAL * self::PIB_PER_CAPITA_INICIAL;

    //valores do ano anterior
    public const K_IMPOSTO_ANO_ANTERIOR = 1/(1-self::PMGC_INICIAL)*(1-self::IMPOSTO_DE_RENDA_INICIAL);
    public const INVESTIMENTOS_ANO_ANTERIOR = self::PIB_INICIAL * 0.15;
    public const IMPOSTOS_ANO_ANTERIOR = self::PIB_INICIAL * 0.25;
    public const GASTOS_GOVERNAMENTAIS_ANO_ANTERIOR = self::IMPOSTOS_ANO_ANTERIOR * 0.80; //80% do imposto arrecadado
    public const TRANSFERENCIAS_ANO_ANTERIOR = self::IMPOSTOS_ANO_ANTERIOR * 0.20; //20% do imposto arrecadado
    public const PIB_ANO_ANTERIOR = self::PIB_INICIAL - self::TRANSFERENCIAS_ANO_ANTERIOR;
    public const CONSUMO_ANO_ANTERIOR = (self::INVESTIMENTOS_ANO_ANTERIOR * self::K_IMPOSTO_ANO_ANTERIOR) - self::INVESTIMENTOS_ANO_ANTERIOR;

    public const BS = self::IMPOSTOS_ANO_ANTERIOR - self::TRANSFERENCIAS_ANO_ANTERIOR - self::GASTOS_GOVERNAMENTAIS_ANO_ANTERIOR;

    //valores que entram por rodada
    public const INVESTIMENTOS_POR_RODADA = 3500000;
    public const GASTOS_GOVERNAMENTAIS_POR_RODADA = 1000000;
}