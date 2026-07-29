<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Department;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature');

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Unit');

/*
|--------------------------------------------------------------------------
| Functions & Helpers
|--------------------------------------------------------------------------
*/

function createHrUser(): User
{
    $department = Department::firstOrCreate(
        ['name' => 'Human Resource'],
        ['description' => 'HR Department', 'status' => 'active']
    );

    $role = Role::firstOrCreate(
        ['title' => 'HR'],
        ['description' => 'HR Role']
    );

    $employee = Employee::create([
        'fullname' => 'HR Admin',
        'email' => 'hr_' . uniqid() . '@example.com',
        'birth_date' => '1990-01-01',
        'hire_date' => '2020-01-01',
        'department_id' => $department->id,
        'role_id' => $role->id,
        'status' => 'active',
        'salary' => 5000,
    ]);

    return User::factory()->create([
        'employee_id' => $employee->id,
    ]);
}

function createStaffUser(string $roleTitle = 'Backend Developer'): User
{
    $department = Department::firstOrCreate(
        ['name' => 'IT Department'],
        ['description' => 'IT Department', 'status' => 'active']
    );

    $role = Role::firstOrCreate(
        ['title' => $roleTitle],
        ['description' => 'Staff Role']
    );

    $employee = Employee::create([
        'fullname' => 'Staff Employee',
        'email' => 'staff_' . uniqid() . '@example.com',
        'birth_date' => '1995-05-05',
        'hire_date' => '2022-01-01',
        'department_id' => $department->id,
        'role_id' => $role->id,
        'status' => 'active',
        'salary' => 3000,
    ]);

    return User::factory()->create([
        'employee_id' => $employee->id,
    ]);
}
