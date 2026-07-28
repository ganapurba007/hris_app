@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Role')
@section('link', route('roles.index'))
@section('previous-title', 'List Data')
@section('page-title', 'Edit Role')

<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('roles._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary me-2">Update Role</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
