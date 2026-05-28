<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employees = Employee::all();
        if ($user->employee->role->title == 'HR') {
            $leave_requests = LeaveRequest::orderBy('created_at', 'desc')->get();
        } else {
            $leave_requests = LeaveRequest::where('employee_id', Auth::user()->employee_id)->orderBy('created_at', 'desc')->get();
        }
        return view('leave_requests.index', compact('leave_requests', 'employees'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'active')->get();
        $leave_requests = LeaveRequest::all();
        return view('leave_requests.create', compact('employees', 'leave_requests'));
    }

    public function store(Request $request)
    {
        if (session('role') == 'HR') {
            $request->validate([
                'employee_id' => 'required',
                'leave_type' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                // 'status' => 'required',
            ]);

            $status = 'Pending';
            $request->merge(['status' => $status]);
            LeaveRequest::create($request->all());
        } else {
            LeaveRequest::create([
                'employee_id' => Auth::user()->employee_id,
                'leave_type' => $request->leave_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'Pending',
            ]);
        }

        return redirect()->route('leave_requests.index')->with('success', 'Leave request created successfully');
    }

    public function edit(LeaveRequest $leave_request)
    {
        // dd($leave_request);
        $employees = Employee::where('status', 'active')->get();
        $leave_requests = LeaveRequest::all();
        return view('leave_requests.edit', compact('leave_request', 'employees', 'leave_requests'));
    }

    public function update(Request $request, LeaveRequest $leave_request)
    {
        $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // $status = $request->input('status');
        // $request->merge(['status' => $status]);

        $leave_request->update($request->all());
        return redirect()->route('leave_requests.index')->with('success', 'Leave request updated successfully');
    }

    public function destroy(LeaveRequest $leave_request)
    {
        $leave_request->delete();
        return redirect()->route('leave_requests.index')->with('success', 'Leave request deleted successfully');
    }

    public function approved(int $id)
    {
        $leave_request = LeaveRequest::find($id);
        $leave_request->update(['status' => 'Approved']);
        return redirect()->route('leave_requests.index')->with('success', 'Leave request approved successfully');
    }
    public function rejected(int $id)
    {
        $leave_request = LeaveRequest::find($id);
        $leave_request->update(['status' => 'Rejected']);
        return redirect()->route('leave_requests.index')->with('success', 'Leave request rejected successfully');
    }
}
