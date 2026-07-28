@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Employee')
@section('link', route('employees.index'))
@section('page-title', 'Edit Employee')
@section('previous-title', 'List Data')
{{-- {{ dd($employee) }} --}}
<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST">

                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        @include('employees._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-3">Update Employee</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
