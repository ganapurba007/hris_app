@extends('layouts.dashboard')
@section('section')
@section('title', 'Edit Payroll')
@section('link', route('payrolls.index'))
@section('page-title', 'Edit Payroll')
@section('previous-title', 'List Data')

<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('payrolls._form')
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary me-2">Update Payroll</button>
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
