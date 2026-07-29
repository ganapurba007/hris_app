<?php

use App\Models\Presence;

test('authenticated user can view presences index page', function () {
    $staff = createStaffUser();

    $response = $this->actingAs($staff)->get(route('presences.index'));

    $response->assertOk();
});

test('staff user can check-in via presence store', function () {
    $staff = createStaffUser();

    $data = [
        'latitude' => '-8.55',
        'longitude' => '125.57',
    ];

    $response = $this->actingAs($staff)->post(route('presences.store'), $data);

    $response->assertRedirect(route('presences.index'));
    $this->assertDatabaseHas('presences', [
        'employee_id' => $staff->employee_id,
        'status' => 'Present',
    ]);
});

test('staff user can render check-out page for own presence', function () {
    $staff = createStaffUser();

    $presence = Presence::create([
        'employee_id' => $staff->employee_id,
        'check_in' => '2026-07-28 08:00:00',
        'date' => '2026-07-28',
        'status' => 'Present',
    ]);

    $response = $this->actingAs($staff)->get(route('presences.check_out', $presence->id));

    $response->assertOk();
});

test('staff user can process check-out', function () {
    $staff = createStaffUser();

    $presence = Presence::create([
        'employee_id' => $staff->employee_id,
        'check_in' => '2026-07-28 08:00:00',
        'date' => '2026-07-28',
        'status' => 'Present',
    ]);

    $response = $this->actingAs($staff)->post(route('presences.check_out_process', $presence->id));

    $response->assertRedirect(route('presences.index'));

    $presence->refresh();
    expect($presence->check_out)->not->toBeNull();
});

test('hr user can create manual presence entry for employee', function () {
    $hr = createHrUser();
    $staff = createStaffUser();

    $presenceData = [
        'employee_id' => $staff->employee_id,
        'date' => '2026-07-28',
        'check_in' => '2026-07-28 08:00:00',
        'check_out' => '2026-07-28 17:00:00',
        'status' => 'Present',
    ];

    $response = $this->actingAs($hr)->post(route('presences.store'), $presenceData);

    $response->assertRedirect(route('presences.index'));
    $this->assertDatabaseHas('presences', [
        'employee_id' => $staff->employee_id,
        'status' => 'Present',
    ]);
});
