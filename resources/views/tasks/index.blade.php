@extends('layouts.dashboard')
@section('section')
@section('title', 'Tasks')
@section('link', route('tasks.index'))
{{-- @section('page-title', 'List Data') --}}
@section('previous-title', 'List Data')
<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="card-title m-0">
                <i class="bi bi-list-task me-2 text-primary"></i>List Data
            </h5>
            <div class="align-item-center">
                @can ('create', App\Models\Task::class)
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill me-1"></i> New Task
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle me-1"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0" id="table1">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Assigned to</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center" style="width: 15%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $task->title }}</td>
                                <td>
                                    <span class="d-inline-flex align-items-center">
                                        {{ $task->employee->fullname ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-nowrap">
                                        {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($task->status === 'Pending')
                                        <span class="badge bg-danger rounded-pill"><i class="bi bi-clock-history me-1"></i>Pending</span>
                                    @elseif ($task->status === 'In Progress')
                                        <span class="badge bg-warning text-dark rounded-pill"><i class="bi bi-arrow-repeat me-1"></i>In Progress</span>
                                    @elseif ($task->status === 'Done')
                                        <span class="badge bg-success rounded-pill"><i class="bi bi-check-circle-fill me-1"></i>Done</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">{{ $task->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Detail Task">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @can ('update', $task)
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Task">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan
                                        @if ($task->status === 'Pending' || $task->status === 'In Progress')
                                            <a href="{{ route('tasks.done', $task->id) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Mark as Done">
                                                <i class="bi bi-check-square-fill"></i>
                                            </a>
                                        @elseif ($task->status === 'Done')
                                            <a href="{{ route('tasks.pending', $task->id) }}" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" title="Mark as Pending">
                                                <i class="bi bi-hourglass-split"></i>
                                            </a>
                                        @endif

                                        @can('delete', $task)
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                class="delete-form d-inline m-0" data-title="Delete Task"
                                                data-text="Task {{ $task->title }} will be permanently deleted.">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete Task">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada data task.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
