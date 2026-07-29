<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (session('role') == 'HR' || ($this->user() && $this->user()->isHr())) {
            return [
                'employee_id' => 'required|exists:employees,id',
                'date' => 'required|date',
                'check_in' => 'required|date',
                'check_out' => 'nullable|date',
                'status' => 'required|in:Present,Absent,Late,Leave',
            ];
        }

        return [
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'The employee field is required.',
            'date.required' => 'The date field is required.',
            'check_in.required' => 'The check-in time field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}
