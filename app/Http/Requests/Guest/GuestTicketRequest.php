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
            'ticket_name' => 'required',
            'category' => 'required',
            'department' => 'required',
            'reported_by' => 'required',
            'reporter_email' => 'required',
            'priority' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ticket_name.required' => 'Please provide a name for the ticket',
            'category.required' => 'Please select a category',
            'department.required' => 'Please select a category',
            'reported_by.required' => 'Please provide the name that reported the fault',
            'reporter_email.required' => 'Please provide the email that reported the fault',
            'priority.required' => 'Please select a priority',
            'assignee.required' => 'Please choose delegation',
            'due_date.required' => 'Please provide a due date',
            'description.required' => 'Please provide a description for the fault'
        ];
    }
}
