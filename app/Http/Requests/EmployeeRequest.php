<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits_between:10,12',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'salary' => 'required|numeric|min:0|max_digits:20',
            'status' => 'required|in:active,inactive,resigned',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'The fullname field is required.',
            'email.required' => 'The email field is required.',
            'phone.required' => 'The phone field is required.',
            'address.required' => 'The address field is required.',
            'birth_date.required' => 'The birth date field is required.',
            'hire_date.required' => 'The hire date field is required.',
            'department_id.required' => 'The department field is required.',
            'role_id.required' => 'The role field is required.',
            'salary.required' => 'The salary field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}
