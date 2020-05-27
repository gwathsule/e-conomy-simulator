<?php

namespace App\Domains\News\Validators;

use App\Support\Validator;

class DeleteNewsValidator extends Validator
{
    public function rules()
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:news,id'
            ],
        ];
    }
}
