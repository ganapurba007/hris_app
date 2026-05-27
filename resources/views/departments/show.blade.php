@extends('layouts.dashboard')
@section('section')
@section('title', 'Detail Department')
@section('link', route('departments.index'))
@section('page-title', 'Detail Department')
@section('previous-title', 'List Data')

    <div class="page-title">
            <div class="col-md-12">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"><i
                            class="bi bi-check-circle"></i>
                        {{ session('error') }}.
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
                                            <label for="first-name-horizontal">Name</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $department->name }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-justify">: {{ $department->description }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Status</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            @if ($department->status === 'active')
                                                <h6>: <span class="badge bg-success">Active</span></h6>
                                            @elseif ($department->status === 'inactive')
                                                <h6>: <span class="badge bg-secondary">Inactive</span></h6>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 d-flex mt-2">
                                            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back to List</a>
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
