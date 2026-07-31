<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Role;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'role'])->orderBy('created_at', 'desc')->get();
        return view('employees.index', compact('employees'));
    }


    public function create()
    {
        $employee = new Employee();
        $departments = Department::where('status', 'active')->get();
        $roles = Role::all();
        return view('employees.create', compact('employee', 'departments', 'roles'));
    }

    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
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
