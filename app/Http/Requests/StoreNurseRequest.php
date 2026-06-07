<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNurseRequest extends FormRequest
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
            'shift' => ['required', 'string', 'max:255', Rule::in(['morning', 'evening', 'night']),],
            'department_id' => ['required', 'exists:departments,id'],
            'employee_id' => ['required', 'exists:employees,id','unique:employees,id'],
        ];
    }
}
