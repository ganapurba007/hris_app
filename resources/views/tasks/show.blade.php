@extends('layouts.dashboard')
@section('section')
@section('title', 'Detail Task')
@section('link', route('tasks.index'))
@section('page-title', 'Detail Task')
@section('previous-title', 'List Data')
    <div class="page-title">
        <div class="row">
            
            <div class="col-md-12">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert""><i
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
                                            <label for="first-name-horizontal">Title</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $task->title }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-justify">: {{ $task->description }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Assigned To/Employee</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $task->employee->fullname }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Due Date</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6>: {{ $task->due_date->format('d F Y') }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Status</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            @if ($task->status === 'Pending')
                                                <h6>: <span class="badge bg-danger">Pending</span></h6>
                                            @elseif ($task->status === 'In Progress')
                                                <h6>: <span class="badge bg-warning">In Progress</span></h6>
                                            @elseif ($task->status === 'Done')
                                                <h6>: <span class="badge bg-success">Done</span></h6>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 d-flex mt-2">
                                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>
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
@endsection
