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
                    @csrf
                    <div class="card-body">
                        @include('roles._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-2">Create Role</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
