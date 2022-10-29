<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminTicketRequest extends FormRequest
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
            'title' => 'required',
            'number' => 'required',
            'category' => 'required',
            'department' => 'required',
            'reported_by' => 'required',
            'reporter_email' => 'required',
            'priority' => 'required',
            'assignee' => 'required',
            'due_date' => 'required',
            'location' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please provide a name for the ticket',
            'category.required' => 'Please select a category',
            'department.required' => 'Please select a category',
            'reported_by.required' => 'Please provide the name that reported the fault',
            'reporter_email.required' => 'Please provide the email that reported the fault',
            'priority.required' => 'Please select a priority',
            'assignee.required' => 'Please choose delegation',
            'due_date.required' => 'Please provide a due date',
            'location.required' => 'Please provide location of the fault',
            'description.required' => 'Please provide a description for the fault'
        ];
    }
}
