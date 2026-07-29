<?php

use App\Models\Task;

test('hr user can view tasks index page', function () {
    $hr = createHrUser();

    $response = $this->actingAs($hr)->get(route('tasks.index'));

    $response->assertOk();
});

test('staff user can view tasks index page', function () {
    $staff = createStaffUser();

    $response = $this->actingAs($staff)->get(route('tasks.index'));

    $response->assertOk();
});

test('hr user can create task assigned to employee', function () {
    $hr = createHrUser();
    $staff = createStaffUser();

    $taskData = [
        'title' => 'Implement Auth Module',
        'description' => 'Build login and registration API endpoints',
        'assigned_to' => $staff->employee_id,
        'due_date' => '2026-08-15',
        'status' => 'Pending',
    ];

    $response = $this->actingAs($hr)->post(route('tasks.store'), $taskData);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'title' => 'Implement Auth Module',
        'assigned_to' => $staff->employee_id,
    ]);
});

test('assigned employee can mark task as done', function () {
    $staff = createStaffUser();

    $task = Task::create([
        'title' => 'Design HRIS Dashboard',
        'description' => 'Create responsive layout for dashboard',
        'assigned_to' => $staff->employee_id,
        'due_date' => '2026-08-10',
        'status' => 'Pending',
    ]);

    $response = $this->actingAs($staff)->get(route('tasks.done', $task->id));

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'status' => 'Done',
    ]);
});

test('assigned employee can mark task as pending', function () {
    $staff = createStaffUser();

    $task = Task::create([
        'title' => 'Refactor Policy Classes',
        'description' => 'Align all policy methods',
        'assigned_to' => $staff->employee_id,
        'due_date' => '2026-08-12',
        'status' => 'Done',
    ]);

    $response = $this->actingAs($staff)->get(route('tasks.pending', $task->id));

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'status' => 'Pending',
    ]);
});

test('hr user can delete task', function () {
    $hr = createHrUser();

    $task = Task::create([
        'title' => 'Temporary Task',
        'description' => 'To be deleted',
        'due_date' => '2026-08-20',
        'status' => 'Pending',
    ]);

    $response = $this->actingAs($hr)->delete(route('tasks.destroy', $task->id));

    $response->assertRedirect(route('tasks.index'));
    $this->assertSoftDeleted('tasks', [
        'id' => $task->id,
    ]);
});
