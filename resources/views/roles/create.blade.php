@extends('layouts.dashboard')
@section('section')
@section('title', 'New Role')
@section('link', route('roles.index'))
@section('previous-title', 'List Data')
@section('page-title', 'New Role')

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('roles.store') }}" method="POST">

                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="title">Task</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control round @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" placeholder="Title Input...">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"
                                            rows="3" placeholder="Description Input...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-3">Create Role</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection;
