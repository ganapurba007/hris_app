@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Leave Request')
@section('link', route('leave_requests.index'))
@section('page-title', 'Edit Leave Request')
@section('previous-title', 'List Data')

<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('leave_requests.update', $leave_request->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('leave_requests._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary me-2">Update Leave Request</button>
                        <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
