<?php

namespace App\Services;

use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;

class PresenceService
{
    /**
     * Get list of presences based on user role.
     */
    public function getPresencesForUser(User $user)
    {
        if ($user->isHr()) {
            return Presence::with('employee')->latest()->get();
        }

        return Presence::with('employee')->where('employee_id', $user->employee_id)->latest()->get();
    }

    /**
     * Create a new presence record (Check-In or HR Manual Entry).
     */
    public function createPresence(User $user, array $data): Presence
    {
        if ($user->isHr()) {
            return Presence::create($data);
        }

        return Presence::create([
            'employee_id' => $user->employee_id,
            'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'date' => Carbon::now()->format('Y-m-d'),
            'status' => 'Present',
        ]);
    }

    /**
     * Process Check-Out for a presence record.
     */
    public function checkoutPresence(Presence $presence): bool
    {
        return $presence->update([
            'check_out' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Update an existing presence record.
     */
    public function updatePresence(Presence $presence, array $data): bool
    {
        return $presence->update($data);
    }
}
