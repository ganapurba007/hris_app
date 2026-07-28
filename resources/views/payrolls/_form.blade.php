<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                <option value="">Select an Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ old('employee_id', $payroll->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
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
            <label for="pay_date" class="form-label">Pay Date</label>
            <input type="date" name="pay_date" id="pay_date"
                class="form-control @error('pay_date') is-invalid @enderror"
                value="{{ old('pay_date', isset($payroll->pay_date) ? \Carbon\Carbon::parse($payroll->pay_date)->format('Y-m-d') : '') }}">
            @error('pay_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3">
            <label class="form-label" for="salary">Salary</label>
            <input type="number" name="salary" id="salary" step="any"
                class="form-control @error('salary') is-invalid @enderror"
                value="{{ old('salary', $payroll->salary ?? '') }}" placeholder="Salary Input...">
            @error('salary')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label class="form-label" for="bonuses">Bonuses</label>
            <input type="number" name="bonuses" id="bonuses" step="any"
                class="form-control @error('bonuses') is-invalid @enderror"
                value="{{ old('bonuses', $payroll->bonuses ?? 0) }}" placeholder="Bonuses Input...">
            @error('bonuses')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label class="form-label" for="deductions">Deductions</label>
            <input type="number" name="deductions" id="deductions" step="any"
                class="form-control @error('deductions') is-invalid @enderror"
                value="{{ old('deductions', $payroll->deductions ?? 0) }}" placeholder="Deductions Input...">
            @error('deductions')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
