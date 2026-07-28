@extends('layouts.dashboard')
@section('section')
@section('title', 'New Employee')
@section('link', route('employees.index'))
@section('page-title', 'New Employee')
@section('previous-title', 'List Data')
<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('employees.store') }}" method="POST">
                    <div class="card-body">
                        @csrf
                        @include('employees._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-3">Save Employee</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
