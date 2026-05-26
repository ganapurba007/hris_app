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
use App\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);

    // HR
    Route::middleware(['role:HR'])->group(function () {
        Route::resource('/employees', EmployeeController::class)->middleware(['role:HR']);
        Route::resource('/departments', DepartmentController::class)->middleware(['role:HR']);
        Route::resource('/roles', RoleController::class)->middleware(['role:HR']);
        Route::get('leave_requests/approved/{id}', [LeaveRequestController::class, 'approved'])->name('leave_requests.approved')->middleware(['role:HR']);
        Route::get('leave_requests/rejected/{id}', [LeaveRequestController::class, 'rejected'])->name('leave_requests.rejected')->middleware(['role:HR']);
    });

    // STAFF
    Route::resource('/presences', PresenceController::class)->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);
    Route::resource('/payrolls', PayrollController::class)->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);
    Route::resource('/tasks', TaskController::class)->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);
    Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done')->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);
    Route::get('tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending')->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);

    Route::resource('/leave_requests', LeaveRequestController::class)->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(['role:HR,Backend Developer,Frontend Developer,Finance Staff']);
});

require __DIR__ . '/auth.php';
