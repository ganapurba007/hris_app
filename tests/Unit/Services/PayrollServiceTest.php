<?php

use App\Services\PayrollService;
use App\Models\Payroll;
use App\Models\Employee;

test('payroll service calculates net salary correctly', function () {
    $service = new PayrollService();

    $data = [
        'salary' => 5000,
        'deductions' => 500,
        'bonuses' => 1000,
    ];

    $result = $service->calculateNetSalary($data);

    expect($result['net_salary'])->toEqual(5500);
});

test('payroll service creates payroll record with calculated net salary', function () {
    $user = createStaffUser();
    $service = new PayrollService();

    $data = [
        'employee_id' => $user->employee_id,
        'salary' => 4000,
        'deductions' => 200,
        'bonuses' => 300,
        'pay_date' => '2026-07-28',
    ];

    $payroll = $service->createPayroll($data);

    expect($payroll)->toBeInstanceOf(Payroll::class);
    expect((float)$payroll->net_salary)->toBe(4100.0);
    $this->assertDatabaseHas('payrolls', [
        'id' => $payroll->id,
        'net_salary' => 4100.0,
    ]);
});

test('payroll service updates payroll record with recalculated net salary', function () {
    $user = createStaffUser();
    $service = new PayrollService();

    $payroll = Payroll::create([
        'employee_id' => $user->employee_id,
        'salary' => 3000,
        'deductions' => 100,
        'bonuses' => 200,
        'net_salary' => 3100,
        'pay_date' => '2026-07-28',
    ]);

    $updateData = [
        'employee_id' => $user->employee_id,
        'salary' => 3500,
        'deductions' => 200,
        'bonuses' => 500,
        'pay_date' => '2026-07-28',
    ];

    $service->updatePayroll($payroll, $updateData);

    $payroll->refresh();

    expect((float)$payroll->salary)->toBe(3500.0);
    expect((float)$payroll->net_salary)->toBe(3800.0);
});
