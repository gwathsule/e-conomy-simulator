<?php

namespace App\Support;

use Illuminate\Support\Facades\Validator as CoreValidator;
use Illuminate\Validation\ValidationException as CoreValidationException;
use App\Support\Exceptions\ValidationException;

abstract class Validator
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Perform validation.
     *
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $this->data = $data;

        $validator = CoreValidator::make(
            $data,
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );
        try {
            $validated = $validator->validate();
        } catch (CoreValidationException $e) {
            throw new ValidationException($e->errors(), $e->getMessage());
        }
        return $validated;
    }
}
