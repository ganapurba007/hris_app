@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Presence')
@section('link', route('presences.index'))
@section('page-title', 'Edit Presence')
@section('previous-title', 'List Data')


    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('presences.update', $presence->id) }}" method="POST">

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
                                                    {{ old('employee_id', $presence->employee_id) == $employee->id ? 'selected' : '' }}>
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
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" name="date" id="date"
                                            class="form-control flatpickr-always-open @error('date') is-invalid @enderror"
                                            placeholder="Select date.." value="{{ old('date', $presence->date) ? old('date', $presence->date)->format('Y-m-d') : '' }}">
                                        @error('date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="check_in" class="form-label">Check In</label>
                                        <input type="text" name="check_in" id="check_in"
                                            class="form-control flatpickr-no-config flatpickr-input @error('check_in') is-invalid @enderror"
                                            placeholder="Select Check In.." value="{{ old('check_in', $presence->check_in) }}">
                                        @error('check_in')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="check_out" class="form-label">Check Out</label>
                                        <input type="text" name="check_out" id="check_out"
                                            class="form-control flatpickr-no-config flatpickr-input @error('check_out') is-invalid @enderror"
                                            placeholder="Select Check In.." value="{{ old('check_out', $presence->check_out) }}">
                                        @error('check_out')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status"
                                            class="choices form-select @error('status') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            <option value="Present"
                                                {{ old('status', $presence->status) == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Late" {{ old('status', $presence->status) == 'Late' ? 'selected' : '' }}>
                                                Late</option>
                                            <option value="Absent" {{ old('status', $presence->status) == 'Absent' ? 'selected' : '' }}>
                                                Absent</option>
                                            <option value="Leave" {{ old('status', $presence->status) == 'Leave' ? 'selected' : '' }}>
                                                Leave</option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-3">Update Presence</button>
                            <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection;
