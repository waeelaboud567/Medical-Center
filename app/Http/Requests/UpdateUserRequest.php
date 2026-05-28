<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
//person
            'first_name' => [
                'sometimes',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'last_name' => [
                'sometimes',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'address' => [
                'sometimes',
                'string',
                'min:5',
                'max:255',
            ],

            'gender' => [
                'sometimes',
                'in:male,female',
            ],

            'date_of_birth' => [
                'sometimes',
                'date',
                'before:today',
            ],

            'phone' => [
                'sometimes',
                'string',
                'size:10',
                'unique:people,phone',
                'regex:/^[0-9+\-\s]+$/'
            ],
//user
            'user_name' => [
                'sometimes',
                'string',
                'min:4',
                'max:30',
                'unique:users,user_name',
                'regex:/^[a-zA-Z0-9_]+$/'
            ],

            'email' => [
                'sometimes',
                'email:rfc,dns',
                'max:255',
                'unique:users,email',
            ],

        ];
    }
}
