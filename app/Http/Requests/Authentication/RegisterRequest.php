<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'confirm_pass' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please provide an email',
            'password.required' => 'Please provide a password',
            'confirm_pass.required' => 'Please repeat your password'
        ];
    }
}
