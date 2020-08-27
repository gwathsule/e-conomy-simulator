<?php

return [
    'inicio' => [
        'qtd_populacao' => env('QTD_POPULACAO', 10000),
        'renda_anual_pessoa' => env('RENDA_ANUAL_PESSOA', 14000),
    ],
    'pib' => [
        'consumo' => env('PIB_PORCENTAGEM_CONSUMO', 0.70),
        'investimento' => env('PIB_PORCENTAGEM_INVESTIMENTO', 0.30),
        'previsao_anual' => env('PIB_PREVISAO_ANUAL', 0.03),
        'previsao_variacao' => env('PIB_PREVISAO_VARIACAO', 0.025),
        'frequencia_calculo' => env('PIB_FREQUENCIA_CALCULO', 12),
        'frequencia_previsao_anual' => env('PIB_FREQUENCIA_PREVISAO_ANUAL', 3),
        'frequencia_comparacao_resultado' => env('PIB_FREQUENCIA_COMPARACAO_RESULTADO', 12),
        'variacao_previsao_pib_positivo' => env('PIB_VARIACAO_PREVISAO_PIB_POSITIVO', 0.5),
        'variacao_previsao_pib_negativo' => env('PIB_VARIACAO_PREVISAO_PIB_NEGATIVO', -0.5),
        'variacao_previsao_pib_modulo' => env('PIB_VARIACAO_PREVISAO_PIB_NEGATIVO', 0.01),
    ],
];
