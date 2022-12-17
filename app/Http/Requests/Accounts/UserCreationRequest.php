<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;

class UserCreationRequest extends FormRequest
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
            'name' => 'required',
            'location' => 'required',
            'email' => 'required',
            'departments_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide a name',
            'location.required' => 'Please provide a location',
            'email.required' => 'Please provide an email'
        ];
    }
}
