<?php

namespace App\Services;

use App\Models\Payroll;

class PayrollService
{
    /**
     * Calculate net salary based on salary, deductions, and bonuses.
     */
    public function calculateNetSalary(array $data): array
    {
        $salary = $data['salary'] ?? 0;
        $deductions = $data['deductions'] ?? 0;
        $bonuses = $data['bonuses'] ?? 0;

        $data['net_salary'] = $salary - $deductions + $bonuses;
        return $data;
    }

    /**
     * Create a new payroll entry with calculated net salary.
     */
    public function createPayroll(array $data): Payroll
    {
        $payload = $this->calculateNetSalary($data);
        return Payroll::create($payload);
    }

    /**
     * Update an existing payroll entry with calculated net salary.
     */
    public function updatePayroll(Payroll $payroll, array $data): bool
    {
        $payload = $this->calculateNetSalary($data);
        return $payroll->update($payload);
    }
}
