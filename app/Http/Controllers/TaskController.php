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
        if ($user->employee->role->title != 'HR') {
            $tasks->where('assigned_to', $user->employee_id);
        }
        $tasks = $tasks->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        $employees = Employee::where('status', 'active')->get();
        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);
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
        $this->authorize('update', $task);
        $employees = Employee::all();
        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
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
        $task = Task::findOrFail($id);
        $this->authorize('changeStatus', $task);
        $task->update(['status' => 'Done']);
        return redirect()->route('tasks.index')->with('success', 'Task Mark as Done successfully');
    }
    public function pending(int $id)
    {
        $task = Task::find($id);
        $this->authorize('changeStatus', $task);
        $task->update(['status' => 'Pending']);
        return redirect()->route('tasks.index')->with('success', 'Task Mark as Pending successfully');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }
}
