@extends('layouts.dashboard')
@section('section')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>New Payroll</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payrolls</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Payroll</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('payrolls.store') }}" method="POST">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="employee_id" class="form-label">Employee</label>
                                        <select class="choices form-select @error('employee_id') is-invalid @enderror"
                                            id="employee_id" name="employee_id">
                                            <option value="">Select an Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
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
                                            placeholder="Select date.." value="{{ old('pay_date') }}">
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
                                            value="{{ old('salary') }}" placeholder="Salary Input...">
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
                                            value="{{ old('bonuses') }}" placeholder="Bonuses Input...">
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
                                            value="{{ old('deductions') }}" placeholder="Deductions Input...">
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
                            <button type="submit" class="btn btn-success me-3">Create Payroll</button>
                            <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection;
