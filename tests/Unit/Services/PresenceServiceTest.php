<?php

use App\Services\PresenceService;
use App\Models\Presence;
use Carbon\Carbon;

test('presence service creates automatic check-in for staff employee', function () {
    $staff = createStaffUser();
    $service = new PresenceService();

    $presence = $service->createPresence($staff, [
        'latitude' => '-8.55',
        'longitude' => '125.57',
    ]);

    expect($presence)->toBeInstanceOf(Presence::class);
    expect($presence->employee_id)->toBe($staff->employee_id);
    expect($presence->status)->toBe('Present');
    $this->assertDatabaseHas('presences', [
        'id' => $presence->id,
        'employee_id' => $staff->employee_id,
        'status' => 'Present',
    ]);
});

test('presence service creates manual entry for HR user', function () {
    $hr = createHrUser();
    $staff = createStaffUser();
    $service = new PresenceService();

    $data = [
        'employee_id' => $staff->employee_id,
        'date' => '2026-07-28',
        'check_in' => '2026-07-28 08:00:00',
        'check_out' => '2026-07-28 17:00:00',
        'status' => 'Present',
    ];

    $presence = $service->createPresence($hr, $data);

    expect($presence)->toBeInstanceOf(Presence::class);
    expect($presence->date->format('Y-m-d'))->toBe('2026-07-28');
    $this->assertDatabaseHas('presences', [
        'id' => $presence->id,
        'employee_id' => $staff->employee_id,
    ]);
});

test('presence service processes check-out successfully', function () {
    $staff = createStaffUser();
    $service = new PresenceService();

    $presence = Presence::create([
        'employee_id' => $staff->employee_id,
        'check_in' => '2026-07-28 08:00:00',
        'date' => '2026-07-28',
        'status' => 'Present',
    ]);

    $service->checkoutPresence($presence);

    $presence->refresh();

    expect($presence->check_out)->not->toBeNull();
});

test('presence service filters presences list correctly based on user role', function () {
    $hr = createHrUser();
    $staff1 = createStaffUser('Backend Developer');
    $staff2 = createStaffUser('Frontend Developer');

    $service = new PresenceService();

    $p1 = Presence::create([
        'employee_id' => $staff1->employee_id,
        'check_in' => '2026-07-28 08:00:00',
        'date' => '2026-07-28',
        'status' => 'Present',
    ]);

    $p2 = Presence::create([
        'employee_id' => $staff2->employee_id,
        'check_in' => '2026-07-28 08:30:00',
        'date' => '2026-07-28',
        'status' => 'Late',
    ]);

    $hrList = $service->getPresencesForUser($hr);
    expect($hrList)->toHaveCount(2);

    $staff1List = $service->getPresencesForUser($staff1);
    expect($staff1List)->toHaveCount(1);
    expect($staff1List->first()->id)->toBe($p1->id);
});
