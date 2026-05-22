@extends('layouts.dashboard')
@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tasks</h3>
                    {{-- <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks
                        to simple-datatables.</p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Tasks</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        List Data
                    </h5>
                    <div class="align-item-center">
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle-fill"></i>&nbsp;
                            New Task</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (session('success'))
                                <div class="alert alert-success"><i class="bi bi-check-circle"></i> {{ session('success') }}.
                                </div>
                            @endif
                        </div>
                    </div>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Title</th>
                                {{-- <th>Description</th> --}}
                                <th>Assigned to</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    {{-- <td>{{ $task->description }}</td> --}}
                                    <td>{{ $task->employee->fullname }}</td>
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
                                        <a href="#" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @if ($task->status === 'Pending' || $task->status === 'In Progress')
                                            <a href="#" class="btn btn-success btn-sm">
                                                <i class="bi bi-check-square-fill"></i>
                                            </a>
                                        @elseif ($task->status === 'Done')
                                            <a href="#" class="btn btn-secondary btn-sm">
                                                <i class="bi bi-hourglass-split"></i>
                                            </a>
                                        @endif
                                        <a href="#" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection;
