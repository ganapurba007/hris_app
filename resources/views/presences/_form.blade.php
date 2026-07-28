@if (session('role') == 'HR' || (Auth::user()->employee && Auth::user()->employee->role && Auth::user()->employee->role->title == 'HR'))
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                    <option value="">Select an Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"
                            {{ old('employee_id', $presence->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->fullname }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date"
                    class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date', isset($presence->date) ? \Carbon\Carbon::parse($presence->date)->format('Y-m-d') : date('Y-m-d')) }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="check_in" class="form-label">Check In</label>
                <input type="datetime-local" name="check_in" id="check_in"
                    class="form-control @error('check_in') is-invalid @enderror"
                    value="{{ old('check_in', isset($presence->check_in) ? \Carbon\Carbon::parse($presence->check_in)->format('Y-m-d\TH:i') : '') }}">
                @error('check_in')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="check_out" class="form-label">Check Out</label>
                <input type="datetime-local" name="check_out" id="check_out"
                    class="form-control @error('check_out') is-invalid @enderror"
                    value="{{ old('check_out', isset($presence->check_out) ? \Carbon\Carbon::parse($presence->check_out)->format('Y-m-d\TH:i') : '') }}">
                @error('check_out')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="">Select Status</option>
                    @foreach (['Present', 'Late', 'Absent', 'Leave'] as $st)
                        <option value="{{ $st }}"
                            {{ old('status', $presence->status ?? '') == $st ? 'selected' : '' }}>
                            {{ $st }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning mb-3">
        <i class="bi bi-geo-alt me-1"></i> You must check in at the appropriate office location.
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label class="form-label" for="latitude">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude Input..." readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group mb-3">
                <label class="form-label" for="longitude">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude Input..." readonly>
            </div>
        </div>
        <div class="col-sm-12 mb-3">
            <div class="ratio ratio-16x9" style="max-height: 300px;">
                <iframe src="" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div>
    </div>
@endif
