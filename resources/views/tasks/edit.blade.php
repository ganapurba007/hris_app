@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Task')
@section('link', route('tasks.index'))
@section('page-title', 'Edit Task')
@section('previous-title', 'List Data')

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">

                        <div class="card-body">

                            @csrf
                            @method('PUT')
                            {{-- {{ dd($task) }} --}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="title">Task</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control round @error('title') is-invalid @enderror"
                                            value="{{ old('title', $task->title) }}" placeholder="Title Input...">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"
                                            rows="3" placeholder="Description Input...">{{ old('description', $task->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="assigned_to" class="form-label">Assigned To/Employee</label>
                                        <select class="choices form-select @error('assigned_to') is-invalid @enderror"
                                            id="assigned_to" name="assigned_to">
                                            <option value="">Select an Employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ old('assigned_to', $task->assigned_to) == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->fullname }}</option>
                                            @endforeach
                                        </select>
                                        @error('assigned_to')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="due_date" class="form-label">Due Date</label>
                                        <input type="date" name="due_date" id="due_date"
                                            class="form-control flatpickr-always-open @error('due_date') is-invalid @enderror"
                                            placeholder="Select date.."
                                            value="{{ old('due_date', $task->due_date) ? old('due_date', $task->due_date)->format('Y-m-d') : '' }}">
                                        @error('due_date')
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
                                            <option value="In Progress"
                                                {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="Pending"
                                                {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
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
                            <button type="submit" class="btn btn-success me-3">Update Task</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection;
