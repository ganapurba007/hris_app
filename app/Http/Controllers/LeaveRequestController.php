<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequestRequest;
use App\Models\LeaveRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employees = Employee::all();
        if ($user->employee && $user->employee->role && $user->employee->role->title == 'HR') {
            $leave_requests = LeaveRequest::orderBy('created_at', 'desc')->get();
        } else {
            $leave_requests = LeaveRequest::where('employee_id', Auth::user()->employee_id)->orderBy('created_at', 'desc')->get();
        }
        return view('leave_requests.index', compact('leave_requests', 'employees'));
    }

    public function create()
    {
        $this->authorize('create', LeaveRequest::class);
        $employees = Employee::where('status', 'active')->get();
        $leave_requests = LeaveRequest::all();
        return view('leave_requests.create', compact('employees', 'leave_requests'));
    }

    public function store(LeaveRequestRequest $request)
    {
        $this->authorize('create', LeaveRequest::class);
        $user = Auth::user();
        
        if ($user->employee && $user->employee->role && $user->employee->role->title == 'HR') {
            $data = $request->validated();
            $data['status'] = 'Pending';
            LeaveRequest::create($data);
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
        $this->authorize('update', $leave_request);
        $employees = Employee::where('status', 'active')->get();
        $leave_requests = LeaveRequest::all();
        return view('leave_requests.edit', compact('leave_request', 'employees', 'leave_requests'));
    }

    public function update(LeaveRequestRequest $request, LeaveRequest $leave_request)
    {
        $this->authorize('update', $leave_request);
        $leave_request->update($request->validated());
        return redirect()->route('leave_requests.index')->with('success', 'Leave request updated successfully');
    }

    public function destroy(LeaveRequest $leave_request)
    {
        $this->authorize('delete', $leave_request);
        $leave_request->delete();
        return redirect()->route('leave_requests.index')->with('success', 'Leave request deleted successfully');
    }

    public function approved(int $id)
    {
        $this->authorize('approved', LeaveRequest::class);
        $leave_request = LeaveRequest::findOrFail($id);
        $leave_request->update(['status' => 'Approved']);
        return redirect()->route('leave_requests.index')->with('success', 'Leave request approved successfully');
    }

    public function rejected(int $id)
    {
        $this->authorize('rejected', LeaveRequest::class);
        $leave_request = LeaveRequest::findOrFail($id);
        $leave_request->update(['status' => 'Rejected']);
        return redirect()->route('leave_requests.index')->with('success', 'Leave request rejected successfully');
    }
}
