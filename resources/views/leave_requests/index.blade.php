@extends('layouts.dashboard')
@section('section')
@section('title', 'Leave Requests')
@section('link', route('leave_requests.index'))
{{-- @section('page-title', 'Leave Requests') --}}
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="card-title m-0">
                <i class="bi bi-calendar2-check me-2 text-primary"></i>List Data
            </h5>
            <div class="align-item-center">
                @can('create', App\Models\LeaveRequest::class)
                    <a href="{{ route('leave_requests.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill me-1"></i> New Request
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
                            <th scope="col">Employee</th>
                            <th scope="col">Leave Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            @can ('update', App\Models\LeaveRequest::class)
                                <th scope="col" class="text-center" style="width: 15%">Options</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leave_requests as $leave)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $leave->employee->fullname ?? '-' }}</td>
                                <td>{{ $leave->leave_type }}</td>
                                <td>
                                    <span class="text-nowrap">
                                        <i class="bi bi-calendar3 me-1 text-muted"></i>
                                        {{ $leave->start_date ? $leave->start_date->format('d M Y') : '-' }} - 
                                        {{ $leave->end_date ? $leave->end_date->format('d M Y') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if (strtolower($leave->status) === 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill"><i class="bi bi-clock-history me-1"></i>Pending</span>
                                    @elseif (strtolower($leave->status) === 'approved')
                                        <span class="badge bg-success rounded-pill"><i class="bi bi-check-circle-fill me-1"></i>Approved</span>
                                    @elseif (strtolower($leave->status) === 'rejected')
                                        <span class="badge bg-danger rounded-pill"><i class="bi bi-x-circle-fill me-1"></i>Rejected</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">{{ $leave->status }}</span>
                                    @endif
                                </td>
                                @can ('update', App\Models\LeaveRequest::class)
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            @if (strtolower($leave->status) === 'rejected' || strtolower($leave->status) === 'pending')
                                                <a href="{{ route('leave_requests.approved', $leave->id) }}"
                                                    class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Approve Request">
                                                    <i class="bi bi-check-square-fill"></i>
                                                </a>
                                            @endif
                                            @if (strtolower($leave->status) === 'approved' || strtolower($leave->status) === 'pending')
                                                <a href="{{ route('leave_requests.rejected', $leave->id) }}"
                                                    class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" title="Reject Request">
                                                    <i class="bi bi-x-square-fill"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('leave_requests.edit', $leave->id) }}"
                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Request">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                           
                                            @can('delete', $leave)
                                                <form action="{{ route('leave_requests.destroy', $leave->id) }}" method="POST"
                                                    class="delete-form d-inline m-0" data-title="Delete Leave Request"
                                                    data-text="Leave request for {{ $leave->employee->fullname ?? 'employee' }} will be permanently deleted.">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete Request">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada data pengajuan cuti.
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
