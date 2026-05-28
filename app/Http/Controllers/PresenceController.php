<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Employee;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $user = Auth::user();
        if ($user->employee->role->title == 'HR') {
            $presences = Presence::latest()->get();
        } else {
            $presences = Presence::where('employee_id', $user->employee_id)->latest()->get();
        }
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
        if (session('role') == 'HR') {
            $request->validate([
                'employee_id' => 'required',
                'date' => 'required|date',
                'check_in' => 'required|date',
                'check_out' => 'required|date',
                'status' => 'required|in:Present,Absent,Late,Leave',
            ]);
            Presence::create($request->all());
        } else {
            Presence::create([
                'employee_id' => Auth::user()->employee_id,
                'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'Present',
            ]);
        }

        // Presence::create($validated);
        return redirect()->route('presences.index')->with('success', 'Presence created successfully');
    }

    public function check_out(Presence $presence)
    {
        return view('presences.check_out', compact('presence'));
    }

    public function check_out_process(Request $request, Presence $presence)
    {
        Presence::where('id', $presence->id)->update([
            'check_out' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('presences.index')->with('success', 'Presence checked out successfully');
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
