<?php

namespace App\Domains\ConfiguracoesGerais;

use Illuminate\Database\Eloquent\Model;

class ConfiguracoesGerais extends Model
{
    //configuracoes jogo
    public const QTD_RODADAS = 24;

    //valores iniciais padrão
    public const POPULACAO = 100000;
    public const PIB_PER_CAPITA = 1200;
    public const PREVISAO_ANUAL = 0.03;
    public const PIB = self::POPULACAO * self::PIB_PER_CAPITA;

    public const CONSUMO = self::PIB * 0.60;
    public const INVESTIMENTO = self::PIB * 0.15;
    public const IMPOSTOS = self::PIB * 0.25;

    public const GASTOS_GOVERNAMENTAIS = self::IMPOSTOS * 0.80; //80% do imposto arrecadado
    public const TRANSFERENCIAS = self::IMPOSTOS * 0.20; //20% do imposto arrecadado
    public const PIB_ANO_ANTERIOR = self::PIB - self::TRANSFERENCIAS;

    public const BS = self::IMPOSTOS - self::TRANSFERENCIAS - self::GASTOS_GOVERNAMENTAIS;
}