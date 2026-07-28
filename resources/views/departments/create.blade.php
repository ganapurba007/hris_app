@extends('layouts.dashboard')
@section('section')
@section('title', 'New Department')
@section('link', route('departments.index'))
@section('page-title', 'New Department')
@section('previous-title', 'List Data')

<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @include('departments._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-2">Create Department</button>
                        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
