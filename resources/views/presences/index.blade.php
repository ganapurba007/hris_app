@extends('layouts.dashboard')
@section('section')
@section('title', 'Presences')
@section('link', route('presences.index'))
{{-- @section('page-title', 'List Data') --}}
@section('previous-title', 'List Data')
<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title">
                List Data
            </h5>
            <div class="align-item-center">
                <a href="{{ route('presences.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>&nbsp;
                    New Presence</a>
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
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences as $presence)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $presence->employee->fullname ?? '-' }} </td>
                            <td>{{ $presence->check_in }}</td>
                            <td>{{ $presence->check_out }}</td>
                            <td>{{ $presence->date->format('d M Y') }}</td>
                            <td>
                                @if ($presence->status === 'Present')
                                    <span class="badge bg-success">Present</span>
                                @elseif ($presence->status === 'Late')
                                    <span class="badge bg-secondary">Late</span>
                                @elseif ($presence->status === 'Absent')
                                    <span class="badge bg-warning">Absent</span>
                                @elseif ($presence->status === 'Leave')
                                    <span class="badge bg-danger">Leave</span>
                                @endif
                            </td>
                            <td class="space-x-1 py-2">
                                @can('update', $presence)
                                    <a href="{{ route('presences.edit', $presence->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan

                                @if (is_null($presence->check_out) && \Carbon\Carbon::parse($presence->date)->isToday())
                                    @can('checkout', $presence)
                                        <a href="{{ route('presences.check_out', $presence) }}"
                                            class="btn btn-secondary btn-sm">
                                            <i class="bi bi-box-arrow-right"></i>
                                        </a>
                                    @endcan
                                @endif

                                @can('delete', $presence)
                                    <form action="{{ route('presences.destroy', $presence->id) }}" method="POST"
                                        class="delete-form m-0" data-title="Delete Presence"
                                        data-text="Presence {{ $presence->employee->fullname ?? '-' }} will be permanently deleted.">
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
