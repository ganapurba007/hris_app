<?php

use App\Models\Payroll;

test('hr user can view payrolls index page', function () {
    $hr = createHrUser();

    $response = $this->actingAs($hr)->get(route('payrolls.index'));

    $response->assertOk();
});

test('staff user can view payrolls index page', function () {
    $staff = createStaffUser();

    $response = $this->actingAs($staff)->get(route('payrolls.index'));

    $response->assertOk();
});

test('hr user can render create payroll page', function () {
    $hr = createHrUser();

    $response = $this->actingAs($hr)->get(route('payrolls.create'));

    $response->assertOk();
});

test('hr user can create new payroll record', function () {
    $hr = createHrUser();
    $staff = createStaffUser();

    $payrollData = [
        'employee_id' => $staff->employee_id,
        'salary' => 5000,
        'bonuses' => 500,
        'deductions' => 200,
        'pay_date' => '2026-07-31',
    ];

    $response = $this->actingAs($hr)->post(route('payrolls.store'), $payrollData);

    $response->assertRedirect(route('payrolls.index'));
    $this->assertDatabaseHas('payrolls', [
        'employee_id' => $staff->employee_id,
        'salary' => 5000,
        'net_salary' => 5300,
    ]);
});

test('hr user can update payroll record', function () {
    $hr = createHrUser();
    $staff = createStaffUser();

    $payroll = Payroll::create([
        'employee_id' => $staff->employee_id,
        'salary' => 4000,
        'bonuses' => 200,
        'deductions' => 100,
        'net_salary' => 4100,
        'pay_date' => '2026-07-31',
    ]);

    $updateData = [
        'employee_id' => $staff->employee_id,
        'salary' => 4500,
        'bonuses' => 300,
        'deductions' => 100,
        'pay_date' => '2026-07-31',
    ];

    $response = $this->actingAs($hr)->put(route('payrolls.update', $payroll->id), $updateData);

    $response->assertRedirect(route('payrolls.index'));
    $this->assertDatabaseHas('payrolls', [
        'id' => $payroll->id,
        'salary' => 4500,
        'net_salary' => 4700,
    ]);
});

test('hr user can delete payroll record', function () {
    $hr = createHrUser();
    $staff = createStaffUser();

    $payroll = Payroll::create([
        'employee_id' => $staff->employee_id,
        'salary' => 3000,
        'bonuses' => 0,
        'deductions' => 0,
        'net_salary' => 3000,
        'pay_date' => '2026-07-31',
    ]);

    $response = $this->actingAs($hr)->delete(route('payrolls.destroy', $payroll->id));

    $response->assertRedirect(route('payrolls.index'));
    $this->assertSoftDeleted('payrolls', [
        'id' => $payroll->id,
    ]);
});
