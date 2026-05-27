@extends('layouts.dashboard')
@section('section')
@section('title', 'New Leave Requests')
@section('link', route('leave_requests.index'))
@section('page-title', 'New Leave Requests')
@section('previous-title', 'List Data')


    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('leave_requests.store') }}" method="POST">

                        <div class="card-body">
                            @csrf
                            <div class="row">
                                @if(session('role') == 'HR')
                                <div class="col-md-12">
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
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="leave_type" class="form-label">Type of Leave</label>
                                        <select name="leave_type" id="leave_type"
                                            class="choices form-select @error('leave_type') is-invalid @enderror">
                                            <option value="">Select Type of Leave</option>
                                            <option value="Annual Leave"
                                                {{ old('leave_type') == 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
                                            <option value="Sick Leave" {{ old('leave_type') == 'Sick Leave' ? 'selected' : '' }}>
                                                Sick Leave</option>
                                            <option value="Maternity Leave" {{ old('leave_type') == 'Maternity Leave' ? 'selected' : '' }}>
                                                Maternity Leave</option>
                                        </select>

                                        @error('leave_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" id="start_date"
                                            class="form-control flatpickr-always-open @error('start_date') is-invalid @enderror"
                                            placeholder="Select date.." value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" name="end_date" id="end_date"
                                            class="form-control flatpickr-always-open @error('end_date') is-invalid @enderror"
                                            placeholder="Select date.." value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status"
                                            class="choices form-select @error('status') is-invalid @enderror">
                                            <option value="">Select status</option>
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>
                                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-3">Create Leave Request</button>
                            <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection;
