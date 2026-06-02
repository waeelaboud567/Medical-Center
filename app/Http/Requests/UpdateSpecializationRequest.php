<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSpecializationRequest extends FormRequest
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
        'specialization_name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('specializations', 'specialization_name')
                ->ignore($this->route('id')),
        ],
        'description' => 'nullable|string|max:255',
    ];
    }
}
