<?php

use App\Models\LeaveRequest;

test('authenticated user can view leave requests index page', function () {
    $staff = createStaffUser();

    $response = $this->actingAs($staff)->get(route('leave_requests.index'));

    $response->assertOk();
});

test('staff user can submit leave request', function () {
    $staff = createStaffUser();

    $leaveData = [
        'leave_type' => 'Annual Leave',
        'start_date' => '2026-08-01',
        'end_date' => '2026-08-05',
    ];

    $response = $this->actingAs($staff)->post(route('leave_requests.store'), $leaveData);

    $response->assertRedirect(route('leave_requests.index'));
    $this->assertDatabaseHas('leave_requests', [
        'employee_id' => $staff->employee_id,
        'leave_type' => 'Annual Leave',
        'status' => 'Pending',
    ]);
});

test('hr user can approve leave request', function () {
    $hr = createHrUser();
    $staff = createStaffUser();

    $leaveRequest = LeaveRequest::create([
        'employee_id' => $staff->employee_id,
        'leave_type' => 'Sick Leave',
        'start_date' => '2026-08-01',
        'end_date' => '2026-08-02',
        'status' => 'Pending',
    ]);

    $response = $this->actingAs($hr)->get(route('leave_requests.approved', $leaveRequest->id));

    $response->assertRedirect(route('leave_requests.index'));
    $this->assertDatabaseHas('leave_requests', [
        'id' => $leaveRequest->id,
        'status' => 'Approved',
    ]);
});

test('hr user can reject leave request', function () {
    $hr = createHrUser();
    $staff = createStaffUser();

    $leaveRequest = LeaveRequest::create([
        'employee_id' => $staff->employee_id,
        'leave_type' => 'Personal Leave',
        'start_date' => '2026-08-01',
        'end_date' => '2026-08-03',
        'status' => 'Pending',
    ]);

    $response = $this->actingAs($hr)->get(route('leave_requests.rejected', $leaveRequest->id));

    $response->assertRedirect(route('leave_requests.index'));
    $this->assertDatabaseHas('leave_requests', [
        'id' => $leaveRequest->id,
        'status' => 'Rejected',
    ]);
});
