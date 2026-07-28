<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];

        if (session('role') == 'HR' || ($this->user() && $this->user()->employee && $this->user()->employee->role && $this->user()->employee->role->title == 'HR')) {
            $rules['employee_id'] = 'required|exists:employees,id';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'The employee field is required.',
            'leave_type.required' => 'The leave type field is required.',
            'start_date.required' => 'The start date field is required.',
            'end_date.required' => 'The end date field is required.',
            'end_date.after_or_equal' => 'The end date must be after or equal to start date.',
        ];
    }
}
