<?php

namespace App\Policies;

use App\Models\Payroll;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PayrollPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Payroll $payroll): bool
    {
        if ($user->employee->role->title == 'HR') {
            return true;
        }
        return $payroll->employee_id == $user->employee_id;
    }

    public function create(User $user): bool
    {
        return $user->employee->role->title == 'HR';
    }

    public function update(User $user, Payroll $payroll): bool
    {
        return $user->employee->role->title == 'HR';
    }

    public function delete(User $user, Payroll $payroll): bool
    {
        return $user->employee->role->title == 'HR';
    }

    public function restore(User $user, Payroll $payroll): bool
    {
        return false;
    }

    public function forceDelete(User $user, Payroll $payroll): bool
    {
        return false;
    }
}
