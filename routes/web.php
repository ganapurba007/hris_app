<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PayrollController;
use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('/tasks', TaskController::class);
Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
Route::get('tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');

Route::resource('/employees', EmployeeController::class);
Route::resource('/departments', DepartmentController::class);
Route::resource('/roles', RoleController::class);
Route::resource('/presences', PresenceController::class);
Route::resource('/payrolls', PayrollController::class);
Route::resource('/leave_requests', LeaveRequestController::class);
Route::get('leave_requests/approved/{id}', [LeaveRequestController::class, 'approved'])->name('leave_requests.approved');
Route::get('leave_requests/rejected/{id}', [LeaveRequestController::class, 'rejected'])->name('leave_requests.rejected');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
