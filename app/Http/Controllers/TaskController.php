<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;



class TaskController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Task::class);
        $user = Auth::user();
        $tasks = Task::with('employee');
        if (!$user->isHr()) {
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

    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);
        Task::create($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $employees = Employee::all();
        return view('tasks.edit', compact('task', 'employees'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());
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
        $task = Task::findOrFail($id);
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
