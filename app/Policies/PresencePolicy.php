<?php

namespace App\Policies;

use App\Models\Presence;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PresencePolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Presence $presence): bool
    {
        if ($user->employee->role->title == 'HR') {
            return true;
        }
        return $presence->employee_id == $user->employee_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user): bool
    {
        return $user->employee->role->title == 'HR';
    }

    public function delete(User $user): bool
    {
        return $user->employee->role->title == 'HR';
    }

    public function restore(User $user, Presence $presence): bool
    {
        return false;
    }

    public function forceDelete(User $user, Presence $presence): bool
    {
        return false;
    }

    public function checkout(User $user, Presence $presence): bool
    {
        if ($user->employee->role->title == 'HR') {
            return true;
        }
        return $presence->employee_id == $user->employee_id;
    }
}
