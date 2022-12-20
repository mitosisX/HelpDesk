<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;

class GuestTicketRequest extends FormRequest
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
            'categories_id' => 'required',
            'priority' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'categories_id.required' => 'Please select a category',
            'priority.required' => 'Please select a priority',
            'description.required' => 'Please provide a description for the fault'
        ];
    }
}
