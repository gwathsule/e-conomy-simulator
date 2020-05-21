<?php

namespace App\Domains\Measure;

/**
 * Essa classe só serve de exemplo
 * Class RecolhimentoCompulsorio
 * @package App\Measures
 */
class RecolhimentoCompulsorio extends Measure
{
    private const CODE = 'recolhimento_compulsorio';

    private const DESCRIPTION = 'Recolhimento Compulsório';

    function getCode(): string
    {
        return self::CODE;
    }

    function getDescription(): string
    {
        return self::DESCRIPTION;
    }

    function calculateMeasure(float $pib, float $unemploymentTax, float $inflation, array $data): array
    {
        $novosValores = [
            'pib' => 0,
            'unemploymentTax' => 0,
            'inflation' => 0,
        ];

        $valor = $data['valor'];
        //randomiza pib
        if(rand(0,1) == 1) {
            $novosValores['pib'] = $pib + $valor;
        } else {
            $novosValores['pib'] = $pib - $valor;
        }
        //randomiza taxa de desemprego
        if(rand(0,1) == 1) {
            $novosValores['unemploymentTax'] = $unemploymentTax + $valor;
        } else {
            $novosValores['unemploymentTax'] = $unemploymentTax - $valor;
        }
        //randomiza inflacão
        if(rand(0,1) == 1) {
            $novosValores['inflation'] = $inflation + $valor;
        } else {
            $novosValores['inflation'] = $inflation - $valor;
        }

        return $novosValores;
    }
}
