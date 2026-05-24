@extends('layouts.dashboard')
@section('section')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Presences</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Presences</a></li>
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
                            @endif
                        </div>
                    </div>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
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
                                        {{-- <a href="{{ route('presences.show', $presence->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye-fill"></i>
                                        </a> --}}
                                        <a href="{{ route('presences.edit', $presence->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    
                                         {{-- MODAL --}}
                                        {{-- <button type="button" class="btn btn-danger btn-sm block" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $presence->id }}"
                                            data-name="{{ $presence->fullname }}">
                                            <i class="bi bi-trash"></i>
                                        </button> --}}

                                        {{-- CONFIRM BAWAAN BROWSER --}}
                                        <form action="{{ route('presences.destroy', $presence->id) }}" method="POST"
                                            style="display:inline"
                                            onsubmit="return confirm('Are you sure you want to delete {{ $presence->employee->fullname ?? 'this data' }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>


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
                        Are you sure you want to delete this task?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancel</span>
                    </button>
                    <form action="{{ route('presences.destroy', $presence->id) }}" method="POST" style="display: inline">
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
