<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title"
        class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $task->title ?? '') }}" placeholder="Input Title...">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" placeholder="Input Description..."
        class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="assigned_to" class="form-label">Assigned To</label>
    <select name="assigned_to" id="assigned_to"
        class="form-control @error('assigned_to') is-invalid @enderror">
        <option value="">-- Select Employee --</option>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}"
                {{ old('assigned_to', $task->assigned_to ?? '') == $employee->id ? 'selected' : '' }}>
                {{ $employee->fullname }}
            </option>
        @endforeach
    </select>
    @error('assigned_to')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="due_date" class="form-label">Due Date</label>
    <input type="date" name="due_date" id="due_date"
        class="form-control @error('due_date') is-invalid @enderror"
        value="{{ \Carbon\Carbon::parse(old('due_date', $task->due_date ?? now()))->format('Y-m-d') }}">
    @error('due_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status"
        class="form-control @error('status') is-invalid @enderror">
        @foreach (['Pending', 'In Progress'] as $status)
            <option value="{{ $status }}"
                {{ old('status', $task->status ?? '') == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>