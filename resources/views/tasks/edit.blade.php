@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Task')
@section('link', route('tasks.index'))
@section('page-title', 'Edit Task')
@section('previous-title', 'List Data')

<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('tasks._form')
                <button type="submit" class="btn btn-success mt-3">Update Task</button>
            </form>
        </div>
    </div>
</section>
@endsection
