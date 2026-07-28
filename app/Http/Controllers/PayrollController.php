<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollRequest;
use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $user = Auth::user();
        if ($user->employee && $user->employee->role && $user->employee->role->title == 'HR') {
            $payrolls = Payroll::orderBy('created_at', 'desc')->get();
        } else {
            $payrolls = Payroll::where('employee_id', $user->employee_id)->orderBy('created_at', 'desc')->get();
        }
        return view('payrolls.index', compact('payrolls', 'employees'));
    }

    public function show(Payroll $payroll)
    {
        $this->authorize('view', $payroll);
        $employees = Employee::findOrFail($payroll->employee_id);
        return view('payrolls.show', compact('payroll', 'employees'));
    }

    public function create()
    {
        $this->authorize('create', Payroll::class);
        $employees = Employee::where('status', 'active')->get();
        $payrolls = Payroll::all();
        return view('payrolls.create', compact('employees', 'payrolls'));
    }

    public function store(PayrollRequest $request)
    {
        $this->authorize('create', Payroll::class);
        $validated = $request->validated();

        $net_salary = $validated['salary'] - $validated['deductions'] + $validated['bonuses'];
        $validated['net_salary'] = $net_salary;

        Payroll::create($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully');
    }

    public function edit(Payroll $payroll)
    {
        $this->authorize('update', $payroll);
        $employees = Employee::where('status', 'active')->get();
        $payrolls = Payroll::all();
        return view('payrolls.edit', compact('payroll', 'employees', 'payrolls'));
    }

    public function update(PayrollRequest $request, Payroll $payroll)
    {
        $this->authorize('update', $payroll);
        $validated = $request->validated();

        $net_salary = $validated['salary'] - $validated['deductions'] + $validated['bonuses'];
        $validated['net_salary'] = $net_salary;

        $payroll->update($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully');
    }

    public function destroy(Payroll $payroll)
    {
        $this->authorize('delete', $payroll);
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully');
    }
}
