<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;

class StaffCreationRequest extends FormRequest
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
            'email' => 'required'
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
