<div class="row">
    @if(session('role') == 'HR' || (Auth::user()->employee && Auth::user()->employee->role && Auth::user()->employee->role->title == 'HR'))
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                    <option value="">Select an Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"
                            {{ old('employee_id', $leave_request->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->fullname }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    @endif

    <div class="col-md-12">
        <div class="form-group mb-3">
            <label for="leave_type" class="form-label">Type of Leave</label>
            <select name="leave_type" id="leave_type" class="form-select @error('leave_type') is-invalid @enderror">
                <option value="">Select Type of Leave</option>
                @foreach (['Annual Leave', 'Sick Leave', 'Maternity Leave'] as $type)
                    <option value="{{ $type }}"
                        {{ old('leave_type', $leave_request->leave_type ?? '') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
            @error('leave_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date"
                class="form-control @error('start_date') is-invalid @enderror"
                value="{{ old('start_date', isset($leave_request->start_date) ? $leave_request->start_date->format('Y-m-d') : '') }}">
            @error('start_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date"
                class="form-control @error('end_date') is-invalid @enderror"
                value="{{ old('end_date', isset($leave_request->end_date) ? $leave_request->end_date->format('Y-m-d') : '') }}">
            @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
