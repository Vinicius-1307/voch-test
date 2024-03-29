<?php

namespace App\Http\Requests\Employee;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePerformanceRequest extends FormRequest
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
            'employee_id' => [
                'integer',
                'required',
                'exists:employees,id'
            ],
            'performance_note' => [
                'numeric',
                'required',
                'between:0,10'
            ],
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new Exception($validator->errors()->first());
    }
}
