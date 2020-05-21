<?php

namespace App\Domains\Measure\Validators;

use App\Support\Validator;

class CalcularRecolhimentoCompulsorioValidator extends Validator
{
    public function rules()
    {
        return [
            'valor' => ['required', 'integer', 'max:10'],
        ];
    }
}
