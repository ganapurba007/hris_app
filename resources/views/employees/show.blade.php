@extends('layouts.dashboard')
@section('section')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Employee</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Employee</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Fullname</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $employee->fullname }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="email-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-justify">: {{ $employee->email }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Phone</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $employee->phone }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Adress</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $employee->address }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Birth Date</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $employee->birth_date }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Hire Date</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $employee->hire_date }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Department</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $employee->department_id }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Role</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $employee->role_id }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Salary</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: Rp{{ number_format($employee->salary) }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password-horizontal">Status</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            @if ($employee->status === 'active')
                                                <h6>: <span class="badge bg-success">{{ $employee->status }}</span></h6>
                                            @elseif ($employee->status === 'inactive')
                                                <h6>: <span class="badge bg-secondary">{{ $employee->status }}</span></h6>
                                            @elseif ($employee->status === 'resigned')
                                                <h6>: <span class="badge bg-danger">{{ $employee->status }}</span></h6>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 d-flex mt-2">
                                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to
                                                List</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection;
