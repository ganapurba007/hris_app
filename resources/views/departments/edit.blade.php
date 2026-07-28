@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Department')
@section('link', route('departments.index'))
@section('page-title', 'Edit Department')
@section('previous-title', 'List Data')

<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('departments._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary me-2">Update Department</button>
                        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
