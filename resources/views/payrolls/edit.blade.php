@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Payroll')
@section('link', route('payrolls.index'))
@section('page-title', 'Edit Payroll')
@section('previous-title', 'List Data')

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST">

                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="employee_id" class="form-label">Employee</label>
                                        <select class="choices form-select @error('employee_id') is-invalid @enderror"
                                            id="employee_id" name="employee_id">
                                            <option value="">Select an Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ old('employee_id', $payroll->employee_id) == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->fullname }}</option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="pay_date" class="form-label">Pay Date</label>
                                        <input type="pay_date" name="pay_date" id="pay_date"
                                            class="form-control flatpickr-always-open @error('pay_date') is-invalid @enderror"
                                            placeholder="Select pay_date.."
                                            value="{{ old('pay_date', $payroll->pay_date) ? old('pay_date', $payroll->pay_date)->format('Y-m-d') : '' }}">
                                        @error('pay_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="salary">Salary</label>
                                        <input type="number" name="salary" id="salary"
                                            class="form-control round @error('salary') is-invalid @enderror"
                                            value="{{ old('salary', $payroll->salary) }}" placeholder="Salary Input...">
                                        @error('salary')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="bonuses">Bonuses</label>
                                        <input type="number" name="bonuses" id="bonuses"
                                            class="form-control round @error('bonuses') is-invalid @enderror"
                                            value="{{ old('bonuses',$payroll->bonuses) }}" placeholder="Bonuses Input...">
                                        @error('bonuses')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="deductions">Deductions</label>
                                        <input type="number" name="deductions" id="deductions"
                                            class="form-control round @error('deductions') is-invalid @enderror"
                                            value="{{ old('deductions', $payroll->deductions) }}"
                                            placeholder="Deductions Input...">
                                        @error('deductions')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-3">Update Payroll</button>
                            <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
