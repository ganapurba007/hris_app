@extends('layouts.dashboard')
@section('section')
@section('title', 'Employees')
@section('link', route('employees.index'))
{{-- @section('page-title', 'List Data') --}}
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="card-title m-0">
                <i class="bi bi-people me-2 text-primary"></i>List Data
            </h5>
            <div class="align-item-center">
                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill me-1"></i> New Employee
                </a>
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
                            <th scope="col">Fullname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center" style="width: 15%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $employee->fullname }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone ?? '-' }}</td>
                                <td>{{ $employee->department->name ?? '-' }}</td>
                                <td>{{ $employee->role->title ?? '-' }}</td>
                                <td>
                                    @if ($employee->status === 'active')
                                        <span class="badge bg-success rounded-pill"><i class="bi bi-check-circle-fill me-1"></i>{{ Str::ucfirst($employee->status) }}</span>
                                    @elseif ($employee->status === 'inactive')
                                        <span class="badge bg-secondary rounded-pill"><i class="bi bi-dash-circle me-1"></i>{{ Str::ucfirst($employee->status) }}</span>
                                    @elseif ($employee->status === 'resigned')
                                        <span class="badge bg-danger rounded-pill"><i class="bi bi-x-circle-fill me-1"></i>{{ Str::ucfirst($employee->status) }}</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">{{ Str::ucfirst($employee->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Detail Employee">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Employee">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                            class="delete-form d-inline m-0" data-title="Delete Employee"
                                            data-text="Employee {{ $employee->fullname }} will be permanently deleted.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete Employee">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada data pegawai.
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
