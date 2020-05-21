<?php

namespace App\Domains\Measures\Validators;

use App\Support\Validator;

class CalcularRecolhimentoCompulsorioValidator extends Validator
{
    public function rules()
    {
        return [
            'valor' => ['integer', 'max:10'],
        ];
    }
}
