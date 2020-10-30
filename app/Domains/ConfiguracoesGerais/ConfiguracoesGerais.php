<?php

namespace App\Domains\ConfiguracoesGerais;

use Illuminate\Database\Eloquent\Model;

class ConfiguracoesGerais extends Model
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
    public const INVESTIMENTOS_ANO_ANTERIOR = self::PIB_INICIAL * 0.15;
    public const IMPOSTOS_ANO_ANTERIOR = self::PIB_INICIAL * 0.25;
    public const GASTOS_GOVERNAMENTAIS_ANO_ANTERIOR = self::IMPOSTOS_ANO_ANTERIOR * 0.80; //80% do imposto arrecadado
    public const TRANSFERENCIAS_ANO_ANTERIOR = self::IMPOSTOS_ANO_ANTERIOR * 0.20; //20% do imposto arrecadado
    //public const PIB_ANO_ANTERIOR = self::PIB_INICIAL - self::TRANSFERENCIAS_ANO_ANTERIOR;

    public const BS = self::IMPOSTOS_ANO_ANTERIOR - self::TRANSFERENCIAS_ANO_ANTERIOR - self::GASTOS_GOVERNAMENTAIS_ANO_ANTERIOR;
}