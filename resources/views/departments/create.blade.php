@extends('layouts.dashboard')
@section('section')
@section('title', 'New Department')
@section('link', route('departments.index'))
@section('page-title', 'New Department')
@section('previous-title', 'List Data')

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('departments.store') }}" method="POST">

                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control round @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Name Input...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"
                                            rows="3" placeholder="Description Input...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status"
                                            class="choices form-select @error('status') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            <option value="active"
                                                {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-3">Create Department</button>
                            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
