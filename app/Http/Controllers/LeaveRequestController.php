<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;

use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $leave_requests = LeaveRequest::orderBy('created_at', 'desc')->get();
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
