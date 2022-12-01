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
            'name' => 'required',
            'categories_id' => 'required',
            'departments_id' => 'required',
            'reported_by' => 'required',
            'reporter_email' => 'required',
            'location' => 'required',
            'priority' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide a name for the ticket',
            'categories_id.required' => 'Please select a category',
            'departments_id.required' => 'Please select a category',
            'reported_by.required' => 'Please provide the name that reported the fault',
            'reporter_email.required' => 'Please provide the email that reported the fault',
            'priority.required' => 'Please select a priority',
            'location.required' => 'Please enter your location of incident',
            'assignee.required' => 'Please choose delegation',
            'due_date.required' => 'Please provide a due date',
            'description.required' => 'Please provide a description for the fault'
        ];
    }
}
