<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollRequest;
use App\Models\Payroll;
use App\Models\Employee;
use App\Services\PayrollService;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $user = Auth::user();

        if ($user->isHr()) {
            $payrolls = Payroll::with('employee')->orderBy('created_at', 'desc')->get();
        } else {
            $payrolls = Payroll::with('employee')->where('employee_id', $user->employee_id)->orderBy('created_at', 'desc')->get();
        }

        return view('payrolls.index', compact('payrolls', 'employees'));
    }

    public function show(Payroll $payroll)
    {
        $this->authorize('view', $payroll);
        $payroll->load('employee');
        return view('payrolls.show', compact('payroll'));
    }

    public function create()
    {
        $this->authorize('create', Payroll::class);
        $employees = Employee::where('status', 'active')->get();
        $payrolls = Payroll::all();
        return view('payrolls.create', compact('employees', 'payrolls'));
    }

    public function store(PayrollRequest $request, PayrollService $payrollService)
    {
        $this->authorize('create', Payroll::class);
        $payrollService->createPayroll($request->validated());

        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully');
    }

    public function edit(Payroll $payroll)
    {
        $this->authorize('update', $payroll);
        $employees = Employee::where('status', 'active')->get();
        $payrolls = Payroll::all();
        return view('payrolls.edit', compact('payroll', 'employees', 'payrolls'));
    }

    public function update(PayrollRequest $request, Payroll $payroll, PayrollService $payrollService)
    {
        $this->authorize('update', $payroll);
        $payrollService->updatePayroll($payroll, $request->validated());

        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully');
    }

    public function destroy(Payroll $payroll)
    {
        $this->authorize('delete', $payroll);
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully');
    }
}
