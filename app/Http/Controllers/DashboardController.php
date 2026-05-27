<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Task;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Presence;
use App\Models\LeaveRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (session('role') == 'HR') {
            $department = Department::count();
            $role = Role::count();
            $employee = Employee::count();
            $task = Task::count();
            $latest_tasks = Task::latest()->take(10)->get();
            return view('dashboard.index', compact('department', 'role', 'employee', 'task', 'latest_tasks'));
        } else {
            $total_task = Task::where('assigned_to', session('employee_id'))->count();
            $pending_task = Task::where('assigned_to', session('employee_id'))->where('status', 'Pending')->count();
            $in_progress_task = Task::where('assigned_to', session('employee_id'))->where('status', 'In Progress')->count();
            $done_task = Task::where('assigned_to', session('employee_id'))->where('status', 'Done')->count();
            $latest_tasks = Task::where('assigned_to', session('employee_id'))->latest()->take(10)->get();
            return view('dashboard.index', compact('total_task', 'pending_task', 'in_progress_task', 'done_task', 'latest_tasks'));
        }
    }

    public function presences()
    {
        $user = Auth::user();
        if (session('role') == 'HR') {
            $data = Presence::where('status', 'Present')
                ->selectRaw('MONTH(date) as month, COUNT(*) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');
        } else {
            $data = Presence::where('status', 'Present')
                ->where('employee_id', $user->employee_id)
                ->selectRaw('MONTH(date) as month, COUNT(*) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');
        }
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = $data[$i] ?? 0;
        }

        return response()->json($months);
    }
}
