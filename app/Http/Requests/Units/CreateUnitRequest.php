<?php

namespace App\Http\Requests\Units;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fantasy_name' => [
                'string',
                'required'
            ],
            'company_name' => [
                'string',
                'required'
            ],
            'cnpj' => [
                'required',
                'string'
            ],
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new Exception($validator->errors()->first());
    }
}
