<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
                'required',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/'
            ],

            'address' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],

            'gender' => [
                'required',
                'in:male,female',
            ],

            'date_of_birth' => [
                'required',
                'date',
                'before:today',
            ],

            'phone' => [
                'required',
                'string',
                'size:10',
                'unique:people,phone',
                'regex:/^[0-9+\-\s]+$/'
            ],
//user
            'user_name' => [
                'required',
                'string',
                'min:4',
                'max:30',
                'unique:users,user_name',
                'regex:/^[a-zA-Z0-9_]+$/'
            ],

            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'max:32',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ];
    }

     public function messages(): array
    {
        return [

            'first_name.regex' =>'First name must contain letters only.',

            'last_name.regex' =>'Last name must contain letters only.',

            'phone.unique' =>'This phone number is already registered.',

            'phone.regex' => 'Phone number format is invalid.',

            'user_name.unique' =>'Username already exists.',

            'user_name.regex' =>'Username can contain only letters, numbers, and underscore.',

            'email.unique' =>'Email already exists.',

            'password.confirmed' =>'Password confirmation does not match.',

            'password.regex' =>'Password must contain uppercase, lowercase, and number.',
        ];
    }
}
