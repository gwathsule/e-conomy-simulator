<?php

namespace App\Domains\User\Validators;

use App\Support\Validator;

class RegisterUserValidator extends Validator
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
