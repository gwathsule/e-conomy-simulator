<?php

namespace App\Domains\Governo\Validators;

use App\Support\Validator;

class StoreGovernoValidator extends Validator
{
    public function rules()
    {
        return [
            'gasto' => ['required', 'float'],
            'receita' => ['required', 'float'],
            'imposto_renda' => ['required', 'float'],
            'taxa_juros' => ['required', 'float'],
            'taxa_deposito_compulsorio' => ['required', 'float'],
            'salario_minimo' => ['required', 'float'],
        ];
    }
}