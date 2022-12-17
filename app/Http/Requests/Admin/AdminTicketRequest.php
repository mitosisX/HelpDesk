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
            'description' => 'required',
            'categories_id' => 'required',
            'priority' => 'required',
            'reported_by' => 'required',
            'assigned_to' => 'required',
            'due_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Please provide a name for the ticket',
            'categories_id.required' => 'Please select a category',
            'reported_by.required' => 'Please provide the name that reported the fault',
            'priority.required' => 'Please select a priority',
            'assigned_to.required' => 'Please choose delegation',
            'due_date.required' => 'Please provide a due date',
        ];
    }
}
