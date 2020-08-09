<?php

namespace App\Domains\Game\Validators;

use App\Support\Validator;

class CreateNewGameValidator extends Validator
{
    public function rules()
    {
        return [
            'pais' => ['required'],
            'moeda' => ['required'],
            'ministro' => ['required'],
            'presidente' => ['required'],
            'descricao' => ['required'],
            'rodadas' => ['required', 'int', 'min:10'],
        ];
    }
}
