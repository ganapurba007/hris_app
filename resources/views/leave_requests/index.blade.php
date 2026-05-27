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
                <a href="{{ route('leave_requests.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>&nbsp;
                    New Request</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert""><i
                                class="bi bi-check-circle"></i>
                            {{ session('success') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>Date</th>
                        {{-- <th>End Date</th> --}}
                        <th>Status</th>
                        @if (session('role') == 'HR')
                            <th>Options</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leave_requests as $leave)
                        <tr>
                            <td>{{ $leave->employee->fullname ?? '-' }} </td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ $leave->start_date->format('d M Y') . ' - ' . $leave->end_date->format('d M Y') }}
                            </td>
                            {{-- <td>{{ $leave->end_date->format('d M Y') }}</td> --}}
                            <td>
                                @if ($leave->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($leave->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($leave->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            @if (session('role') == 'HR')
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
                                    {{-- <a href="{{ route('leave_requests.show', $leave->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye-fill"></i>
                                        </a> --}}
                                    <a href="{{ route('leave_requests.edit', $leave->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- MODAL --}}
                                    {{-- <button type="button" class="btn btn-danger btn-sm block" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $leave->id }}"
                                            data-name="{{ $leave->fullname }}">
                                            <i class="bi bi-trash"></i>
                                        </button> --}}

                                    {{-- CONFIRM BAWAAN BROWSER --}}
                                    <form action="{{ route('leave_requests.destroy', $leave->id) }}" method="POST"
                                        style="display:inline"
                                        onsubmit="return confirm('Are you sure you want to delete {{ $leave->employee->fullname ?? 'this data' }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


{{-- MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="text-white modal-title" id="deleteModalTitle">Confirmation
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this data?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cancel</span>
                </button>
                <form action="{{ route('leave_requests.destroy', $leave->id) }}" method="POST"
                    style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Delete</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection;
