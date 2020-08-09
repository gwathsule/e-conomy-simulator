<?php

return [
    'inicio' => [
        'qtd_populacao' => env('QTD_POPULACAO', 10000),
        'renda_anual_pessoa' => env('RENDA_ANUAL_PESSOA', 14000),
    ],
    'pib' => [
        'consumo' => env('PIB_PORCENTAGEM_CONSUMO', 0.7),
        'investimento' => env('PIB_PORCENTAGEM_INVESTIMENTO', 0.3),
    ],
];
