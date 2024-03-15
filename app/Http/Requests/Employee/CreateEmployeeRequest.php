<?php

namespace App\Http\Requests\Employee;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'unit_id' => [
                'integer',
                'required',
                'exists:units,id'
            ],
            'name' => [
                'string',
                'required'
            ],
            'cpf' => [
                'required',
                'unique:employees,cpf'
            ],
            'email' => [
                'required',
                'string'
            ],
            'position_id' => [
                'required',
                'exists:positions,id'
            ]
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new Exception($validator->errors()->first());
    }
}
