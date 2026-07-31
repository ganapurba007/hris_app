@extends('layouts.dashboard')
@section('section')
@section('title', 'New Task')
@section('link', route('tasks.index'))
@section('page-title', 'New Task')
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                @include('tasks._form')
                <button type="submit" class="btn btn-success mt-3">Save Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Back to List</a>
            </form>
        </div>
    </div>
</section>

@endsection
