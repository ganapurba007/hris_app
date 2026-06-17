@extends('layouts.dashboard')
@section('section')
@section('title', 'Leave Requests')
@section('link', route('leave_requests.index'))
{{-- @section('page-title', 'Leave Requests') --}}
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title">
                List Data
            </h5>
            <div class="align-item-center">
                @can('create', App\Models\LeaveRequest::class)
                <a href="{{ route('leave_requests.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>&nbsp;
                    New Request</a>
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
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>Date</th>
                        {{-- <th>End Date</th> --}}
                        <th>Status</th>
                        @can ('update', App\Models\LeaveRequest::class)
                            <th>Options</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leave_requests as $leave)
                        <tr>
                            <td>{{ $loop->iteration }} </td>
                            <td>{{ $leave->employee->fullname ?? '-' }} </td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ $leave->start_date->format('d M Y') . ' - ' . $leave->end_date->format('d M Y') }}
                            </td>
                            <td>
                                @if ($leave->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($leave->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($leave->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            @can ('update', App\Models\LeaveRequest::class)
                                <td class="space-x-1 py-2">
                                    @if ($leave->status === 'rejected' || $leave->status === 'pending')
                                        <a href="{{ route('leave_requests.approved', $leave->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="bi bi-check-square-fill"></i>
                                        </a>
                                    @endif
                                    @if ($leave->status === 'approved' || $leave->status === 'pending')
                                        <a href="{{ route('leave_requests.rejected', $leave->id) }}"
                                            class="btn btn-secondary btn-sm">
                                            <i class="bi bi-x-square-fill"></i>
                                        </a>
                                    @endif ()
                                    <a href="{{ route('leave_requests.edit', $leave->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                   
                                    @can('delete', $leave)
                                    <form action="{{ route('leave_requests.destroy', $leave->id) }}" method="POST"
                                        class="delete-form m-0" data-title="Delete Task"
                                        data-text="Task {{ $leave->employee->fullname }} will be permanently deleted.">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
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
