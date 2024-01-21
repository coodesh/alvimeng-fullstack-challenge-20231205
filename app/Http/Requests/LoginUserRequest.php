<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'=>'required|string|email',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'The email must be a valid email address.',
        
            'password.required' => 'The password field is required.',
        ];
        
    }
}
