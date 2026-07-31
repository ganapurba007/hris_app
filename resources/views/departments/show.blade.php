@extends('layouts.dashboard')
@section('title', 'Detail Department')
@section('link', route('departments.index'))
@section('page-title', 'Detail Department')
@section('previous-title', 'List Data')

@section('section')
<div class="page-title mb-3">
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle me-1"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
</div>

<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">
                        <i class="bi bi-building me-2 text-primary"></i>Department Details
                    </h5>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-3 fw-bold">Name</div>
                            <div class="col-md-9 fw-semibold">{{ $department->name }}</div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-md-3 fw-bold">Description</div>
                            <div class="col-md-9">{{ $department->description }}</div>
                        </div>

                        <div class="row align-items-center mb-4">
                            <div class="col-md-3 fw-bold">Status</div>
                            <div class="col-md-9">
                                @if ($department->status === 'active')
                                    <span class="badge bg-success rounded-pill px-3"><i class="bi bi-check-circle-fill me-1"></i>Active</span>
                                @elseif ($department->status === 'inactive')
                                    <span class="badge bg-secondary rounded-pill px-3"><i class="bi bi-dash-circle me-1"></i>Inactive</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3">{{ Str::ucfirst($department->status) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="pt-3 border-top">
                            <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
