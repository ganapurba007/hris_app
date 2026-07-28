<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresenceRequest;
use App\Models\Presence;
use App\Models\Employee;
use App\Services\PresenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index(PresenceService $presenceService)
    {
        $employees = Employee::all();
        $presences = $presenceService->getPresencesForUser(Auth::user());

        return view('presences.index', compact('presences', 'employees'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'active')->get();
        $presences = Presence::all();
        return view('presences.create', compact('employees', 'presences'));
    }

    public function store(PresenceRequest $request, PresenceService $presenceService)
    {
        $presenceService->createPresence(Auth::user(), $request->validated());

        return redirect()->route('presences.index')->with('success', 'Presence created successfully');
    }

    public function check_out(Presence $presence)
    {
        $this->authorize('checkout', $presence);
        return view('presences.check_out', compact('presence'));
    }

    public function check_out_process(Request $request, Presence $presence, PresenceService $presenceService)
    {
        $this->authorize('checkout', $presence);
        $presenceService->checkoutPresence($presence);

        return redirect()->route('presences.index')->with('success', 'Presence checked out successfully');
    }

    public function edit(Presence $presence)
    {
        $this->authorize('update', $presence);
        $employees = Employee::where('status', 'active')->get();
        $presences = Presence::all();
        return view('presences.create', compact('presence', 'employees', 'presences'));
    }

    public function update(PresenceRequest $request, Presence $presence, PresenceService $presenceService)
    {
        $this->authorize('update', $presence);
        $presenceService->updatePresence($presence, $request->validated());

        return redirect()->route('presences.index')->with('success', 'Presence updated successfully');
    }

    public function destroy(Presence $presence)
    {
        $this->authorize('delete', $presence);
        $presence->delete();
        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully');
    }
}
