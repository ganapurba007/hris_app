<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('created_at', 'desc')->get();
        return view('departments.index', compact('departments'));
    }


    public function create()
    {
        $departments = Department::all();
        return view('departments.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Department::create($validated);
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    public function edit(Department $department)
    {
        $departments = Department::all();
        return view('departments.edit', compact('departments'));
    }

    public function update(Request $request, Department $department)
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

        $department->update($validated);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }
}
