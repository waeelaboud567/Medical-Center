<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'person_id' => [
                'sometimes',
                'integer',
                'exists:people,id',
                'unique:employees,person_id'
            ],
            'hire_date' => [
                'sometimes',
                'date',
                'before_or_equal:today'
            ],

            'salary' => [
                'sometimes',
                'numeric',
                'min:0',
                'max:999999.99'
            ],

            'employment_status' => [
                'sometimes',
                'in:active,on_leave,terminated'
            ],
        ];
    }
}
