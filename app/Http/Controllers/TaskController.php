<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', with(['tasks' => $tasks]));
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
