<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Employee;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $presences = Presence::orderBy('created_at', 'desc')->get();
        return view('presences.index', compact('presences', 'employees'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'active')->get();
        $presences = Presence::all();
        return view('presences.create', compact('employees', 'presences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'date' => 'required|date',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'status' => 'required|in:Present,Absent,Late,Leave',
        ]);

        Presence::create($validated);
        return redirect()->route('presences.index')->with('success', 'Presence created successfully');
    }

    public function edit(Presence $presence)
    {
        $employees = Employee::where('status', 'active')->get();
        $presences = Presence::all();
        return view('presences.edit', compact('presence', 'employees', 'presences'));
    }

    public function update(Request $request, Presence $presence)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'date' => 'required|date',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'status' => 'required|in:Present,Absent,Late,Leave',
        ]);

        $presence->update($validated);
        return redirect()->route('presences.index')->with('success', 'Presence updated successfully');
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();
        return redirect()->route('presences.index')->with('success', 'Presence deleted successfully');
    }
}
