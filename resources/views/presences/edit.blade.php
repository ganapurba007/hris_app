@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Presence')
@section('link', route('presences.index'))
@section('page-title', 'Edit Presence')
@section('previous-title', 'List Data')

<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('presences.update', $presence->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('presences._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary me-2">Update Presence</button>
                        <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
