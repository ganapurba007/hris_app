@extends('layouts.dashboard')
@section('section')
@section('title', 'Tasks')
@section('link', route('tasks.index'))
{{-- @section('page-title', 'List Data') --}}
@section('previous-title', 'List Data')
<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title">
                List Data
            </h5>
            <div class="align-item-center">
                @can ('create', App\Models\Task::class)
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill"></i>&nbsp;
                        New Task</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"><i
                                class="bi bi-check-circle"></i>
                            {{ session('success') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert"><i
                                class="bi bi-x-circle"></i>
                            {{ session('error') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Assigned to</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->employee->fullname ?? '-' }} </td>
                            <td>{{ $task->due_date->format('d M Y') }}</td>
                            <td>
                                @if ($task->status === 'Pending')
                                    <span class="badge bg-danger">Pending</span>
                                @elseif ($task->status === 'In Progress')
                                    <span class="badge bg-warning">In Progress</span>
                                @elseif ($task->status === 'Done')
                                    <span class="badge bg-success">Done</span>
                                @endif
                            </td>
                            <td class="space-x-1 py-2">
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @can ('update', $task)
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endif
                                @if ($task->status === 'Pending' || $task->status === 'In Progress')
                                    <a href="{{ route('tasks.done', $task->id) }}" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-square-fill"></i>
                                    </a>
                                @elseif ($task->status === 'Done')
                                    <a href="{{ route('tasks.pending', $task->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-hourglass-split"></i>
                                    </a>
                                @endif

                                @can('delete', $task)
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        class="delete-form m-0" data-title="Delete Task"
                                        data-text="Task {{ $task->title }} will be permanently deleted.">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection
