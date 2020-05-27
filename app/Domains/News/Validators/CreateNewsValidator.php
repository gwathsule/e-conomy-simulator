<?php

namespace App\Domains\News\Validators;

use App\Support\Validator;

class CreateNewsValidator extends Validator
{
    public function validate(array $data)
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'newscast' => ['required'],
            'image' => ['required', 'image'],
        ];
    }
}
