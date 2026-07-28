<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'pay_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'bonuses' => 'required|numeric|min:0',
            'deductions' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required' => 'The employee field is required.',
            'pay_date.required' => 'The pay date field is required.',
            'salary.required' => 'The salary field is required.',
            'bonuses.required' => 'The bonuses field is required.',
            'deductions.required' => 'The deductions field is required.',
        ];
    }
}
