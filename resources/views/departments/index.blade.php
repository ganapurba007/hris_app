@extends('layouts.dashboard')
@section('section')
@section('title', 'Departments')
@section('link', route('departments.index'))
{{-- @section('page-title', 'List Data') --}}
@section('previous-title', 'List Data')

        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        List Data
                    </h5>
                    <div class="align-item-center">
                        <a href="{{ route('departments.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle-fill"></i>&nbsp;
                            New Department</a>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->description }}</td>
                                    <td>
                                        @if ($department->status === 'active')
                                            <span class="badge bg-success">{{ Str::ucfirst($department->status) }}</span>
                                        @elseif ($department->status === 'inactive')
                                            <span class="badge bg-secondary">{{ Str::ucfirst($department->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="space-x-1 py-2">
                                        {{-- <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye-fill"></i>
                                        </a> --}}
                                        <a href="{{ route('departments.edit', $department->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- MODAL --}}
                                        {{-- <button type="button" class="btn btn-danger btn-sm block" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $department->id }}"
                                            data-name="{{ $department->fullname }}">
                                            <i class="bi bi-trash"></i>
                                        </button> --}}

                                        {{-- CONFIRM BAWAAN BROWSER --}}
                                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                            style="display:inline"
                                            onsubmit="return confirm('Are you sure you want to delete {{ $department->name }}?')">
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


    {{-- MODAL --}}
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle"
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
                        Are you sure you want to delete this employee?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancel</span>
                    </button>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline">
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
    </div> --}}


    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
        });
    </script>
@endsection;
