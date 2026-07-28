<?php

namespace App\Policies;

use App\Models\Presence;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PresencePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ?Presence $presence = null): bool
    {
        if ($user->isHr()) {
            return true;
        }
        return $presence ? $presence->employee_id == $user->employee_id : false;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ?Presence $presence = null): bool
    {
        return $user->isHr();
    }

    public function delete(User $user, ?Presence $presence = null): bool
    {
        return $user->isHr();
    }

    public function restore(User $user, ?Presence $presence = null): bool
    {
        return false;
    }

    public function forceDelete(User $user, ?Presence $presence = null): bool
    {
        return false;
    }

    public function checkout(User $user, ?Presence $presence = null): bool
    {
        if ($user->isHr()) {
            return true;
        }
        return $presence ? $presence->employee_id == $user->employee_id : true;
    }
}
