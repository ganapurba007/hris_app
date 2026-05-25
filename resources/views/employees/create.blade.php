@extends('layouts.dashboard')
@section('section')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>New Employee</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('employees.store') }}" method="POST">

                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="fullname">Fullname</label>
                                        <input type="text" name="fullname" id="fullname"
                                            class="form-control round @error('fullname') is-invalid @enderror"
                                            value="{{ old('fullname') }}" placeholder="Fullname Input...">
                                        @error('fullname')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control round @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Email Input...">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="number" name="phone" id="phone"
                                            class="form-control round @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" placeholder="Phone Input...">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control  @error('address') is-invalid @enderror" name="address" id="address" rows="3"
                                            placeholder="Address Input...">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="birth_date" class="form-label">Birth Date</label>
                                        <input type="date" name="birth_date" id="birth_date"
                                            class="form-control flatpickr-always-open @error('birth_date') is-invalid @enderror"
                                            placeholder="Select date.." value="{{ old('birth_date') }}">
                                        @error('birth_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="hire_date" class="form-label">Hire Date</label>
                                        <input type="date" name="hire_date" id="hire_date"
                                            class="form-control flatpickr-always-open @error('hire_date') is-invalid @enderror"
                                            placeholder="Select date.." value="{{ old('hire_date') }}">
                                        @error('hire_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="department_id" class="form-label">Department</label>
                                        <select class="choices form-select @error('department_id') is-invalid @enderror"
                                            id="department_id" name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="role_id" class="form-label">Role</label>
                                        <select class="choices form-select @error('role_id') is-invalid @enderror"
                                            id="role_id" name="role_id">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
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
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status"
                                            class="choices form-select @error('status') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                            <option value="resigned" {{ old('status') == 'resigned' ? 'selected' : '' }}>
                                                Resigned</option>
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
                            <button type="submit" class="btn btn-success me-3">Save Employee</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection;
