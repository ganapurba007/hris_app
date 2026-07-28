@extends('layouts.dashboard')
@section('section')
@section('title', 'Presences')
@section('link', route('presences.index'))
{{-- @section('page-title', 'List Data') --}}
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="card-title m-0">
                <i class="bi bi-clock-history me-2 text-primary"></i>List Data
            </h5>
            <div class="align-item-center">
                @can ('create', App\Models\Presence::class)
                    <a href="{{ route('presences.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill me-1"></i> New Presence
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
                            <th scope="col">Date</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Status</th>
                            @can ('update', App\Models\Presence::class)
                                <th scope="col" class="text-center" style="width: 15%">Options</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presences as $presence)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $presence->employee->fullname ?? '-' }}</td>
                                <td>
                                    <span class="text-nowrap">
                                        <i class="bi bi-calendar3 me-1 text-muted"></i>
                                        {{ $presence->date ? \Carbon\Carbon::parse($presence->date)->format('d M Y') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-nowrap text-success fw-medium">
                                        {{ $presence->check_in ? \Carbon\Carbon::parse($presence->check_in)->format('H:i:s') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-nowrap text-danger fw-medium">
                                        {{ $presence->check_out ? \Carbon\Carbon::parse($presence->check_out)->format('H:i:s') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($presence->status === 'Present')
                                        <span class="badge bg-success rounded-pill"><i class="bi bi-check-circle-fill me-1"></i>Present</span>
                                    @elseif ($presence->status === 'Late')
                                        <span class="badge bg-warning text-dark rounded-pill"><i class="bi bi-exclamation-triangle-fill me-1"></i>Late</span>
                                    @elseif ($presence->status === 'Absent')
                                        <span class="badge bg-danger rounded-pill"><i class="bi bi-x-circle-fill me-1"></i>Absent</span>
                                    @elseif ($presence->status === 'Leave')
                                        <span class="badge bg-info rounded-pill"><i class="bi bi-person-dash me-1"></i>Leave</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">{{ $presence->status }}</span>
                                    @endif
                                </td>
                                @can ('update', App\Models\Presence::class)
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            @can ('checkout', $presence)
                                                @if ($presence->check_in && !$presence->check_out)
                                                    <a href="{{ route('presences.check_out', $presence->id) }}"
                                                        class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Check Out">
                                                        <i class="bi bi-box-arrow-right"></i>
                                                    </a>
                                                @endif
                                            @endcan
                                            <a href="{{ route('presences.edit', $presence->id) }}"
                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Presence">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            @can('delete', $presence)
                                                <form action="{{ route('presences.destroy', $presence->id) }}" method="POST"
                                                    class="delete-form d-inline m-0" data-title="Delete Presence"
                                                    data-text="Presence record for {{ $presence->employee->fullname ?? 'employee' }} will be permanently deleted.">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete Presence">
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
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada data presensi.
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
