@extends('layouts.dashboard')
@section('section')
@section('title', 'Detail Role')
@section('link', route('roles.index'))
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
                                            <h6>: {{ $role->title }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-justify">: {{ $role->description }}</h6>
                                        </div>
                                        <div class="col-sm-12 d-flex mt-2">
                                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
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
