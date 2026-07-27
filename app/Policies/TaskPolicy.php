<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        if ($user->isHr()) {
            return true;
        }
        return $task->assigned_to == $user->employee_id;
    }

    public function create(User $user): bool
    {
        return $user->isHr();
    }

    public function update(User $user, Task $task): bool
    {
        return $user->isHr();
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->isHr();
    }

    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }

    public function changeStatus(User $user, Task $task): bool
    {
        if ($user->isHr()) {
            return true;
        }
        return $task->assigned_to == $user->employee_id;
    }
}
