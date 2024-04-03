<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'txt_user' => ['required', 'email'],
            'txt_pass' => ['required', 'min:3', 'max:20']
        ];
    }

    public function messages() {
        return [
            'txt_user.required' => 'The user is mandatory.',
            'txt_user.email' => 'The user must have a valid email address.',
            'txt_pass.required' => 'The password is mandatory.',
            'txt_pass.min' => 'The password must be at least :min characters long.',
            'txt_pass.max' => 'The password must be a maximum of :max characters.'
        ];
    }
}
