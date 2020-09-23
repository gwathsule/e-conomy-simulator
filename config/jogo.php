<?php

return [
    'pib' => [
        'previsao_variacao' => env('PIB_PREVISAO_VARIACAO', 0.025),
        'frequencia_calculo' => env('PIB_FREQUENCIA_CALCULO', 12),
        'frequencia_previsao_anual' => env('PIB_FREQUENCIA_PREVISAO_ANUAL', 3),
        'frequencia_comparacao_resultado' => env('PIB_FREQUENCIA_COMPARACAO_RESULTADO', 12),
        'variacao_previsao_pib_modulo' => env('PIB_VARIACAO_PREVISAO_PIB_NEGATIVO', 0.01),
    ],
];
