<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::with('employee');
        if ($user->role != 'HR') {
            $tasks->where('assigned_to', $user->employee_id);
        }
        $tasks = $tasks->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::get()->where('status', 'active');
        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date',
            'status' => 'required|in:Pending,In Progress',
        ]);


        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        $employees = Employee::all();
        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'assigned_to' => 'required|exists:employees,id',
            'due_date' => 'required|date',
            'status' => 'required|in:Pending,In Progress',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function done(int $id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'Done']);
        return redirect()->route('tasks.index')->with('success', 'Task Mark as Done successfully');
    }
    public function pending(int $id)
    {
        $task = Task::find($id);
        $task->update(['status' => 'Pending']);
        return redirect()->route('tasks.index')->with('success', 'Task Mark as Pending successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
}
