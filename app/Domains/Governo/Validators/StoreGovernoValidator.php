<?php

namespace App\Domains\Governo\Validators;

use App\Support\Validator;

class StoreGovernoValidator extends Validator
{
    public function rules()
    {
        return [
            'gasto' => ['required', 'numeric'],
            'receita' => ['required', 'numeric'],
            'imposto_renda' => ['required', 'numeric'],
            'taxa_juros' => ['required', 'numeric'],
            'taxa_deposito_compulsorio' => ['required', 'numeric'],
            'salario_minimo' => ['required', 'numeric'],
        ];
    }
}