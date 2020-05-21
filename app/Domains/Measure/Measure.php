<?php

namespace App\Domains\Measure;

use App\Domains\Timeline\Timeline;
use App\Support\Exceptions\InternalErrorException;
use Illuminate\Support\Facades\Validator as CoreValidator;
use Illuminate\Validation\ValidationException as CoreValidationException;

abstract class Measure
{
    /**
     * Perform the measurement, calculating and returning the pib, unemploymentTax and inflation values on an array
     * should be return a array as ['pib' => $value, 'unemploymentTax' => $value, 'inflation' => $value]
     * @param float $pib
     * @param float $unemploymentTax
     * @param float $inflation
     * @param array $data
     * @return array
     */
    abstract function calculateMeasure(float $pib, float $unemploymentTax, float $inflation, array $data) : array;

    /**
     * Get the measure code to save in timeline
     * @return string
     */
    abstract function getCode() : string ;

    /**
     * Get the measure description to save in timeline
     * @return string
     */
    abstract function getDescription() : string ;

    /**
     * @param Timeline $actualTimeline
     * @param array $data
     * @return array
     * @throws InternalErrorException
     */
    public function handle(Timeline $actualTimeline, array $data)
    {
        $newInfo = $this->calculateMeasure(
            $actualTimeline->pib,
            $actualTimeline->unemployment_tax,
            $actualTimeline->unemployment_tax,
            $data
        );

        $this->validateReturn($newInfo);

        return $newInfo;
    }

    private function validateReturn(array $info)
    {
       $rules = [
            'pib' => ['required', 'numeric'],
            'unemploymentTax' => ['required', 'numeric'],
            'inflation' => ['required', 'numeric'],
        ];

        $validator = CoreValidator::make(
            $info,
            $rules
        );
        try {
            $validator->validate();
        } catch (CoreValidationException $e) {
            throw new InternalErrorException(
                "Problemas ao efetuar medida",
                "Erro ao validar as informações retorndas da medida de código " . $this->getCode() . " " .
                "verifique se o array retornado possui as chaves 'pib', 'unemploymentTax' e 'inflation'"
            );
        }
    }
}
