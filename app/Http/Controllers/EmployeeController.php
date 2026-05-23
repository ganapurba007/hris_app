<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->get();
        return view('employees.index', compact('employees'));
    }


    public function create()
    {
        $departments = Department::get()->where('status', 'active');
        $roles = Role::all();
        return view('employees.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
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
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }
}
