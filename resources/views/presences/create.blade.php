@extends('layouts.dashboard')
@section('section')
@section('title', 'New Presence')
@section('link', route('presences.index'))
@section('page-title', 'New Presence')
@section('previous-title', 'List Data')

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('role') == 'HR')
                        <form action="{{ route('presences.store') }}" method="POST">

                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="employee_id" class="form-label">Employee</label>
                                            <select class="choices form-select @error('employee_id') is-invalid @enderror"
                                                id="employee_id" name="employee_id">
                                                <option value="">Select an Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}"
                                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->fullname }}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" name="date" id="date"
                                                class="form-control flatpickr-always-open @error('date') is-invalid @enderror"
                                                placeholder="Select date.." value="{{ old('date') }}">
                                            @error('date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="check_in" class="form-label">Check In</label>
                                            <input type="text" name="check_in" id="check_in"
                                                class="form-control flatpickr-no-config flatpickr-input @error('check_in') is-invalid @enderror"
                                                placeholder="Select Check In.." value="{{ old('check_in') }}">
                                            @error('check_in')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="check_out" class="form-label">Check Out</label>
                                            <input type="text" name="check_out" id="check_out"
                                                class="form-control flatpickr-no-config flatpickr-input @error('check_out') is-invalid @enderror"
                                                placeholder="Select Check In.." value="{{ old('check_out') }}">
                                            @error('check_out')
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
                                                <option value="Present" {{ old('status') == 'Present' ? 'selected' : '' }}>
                                                    Present</option>
                                                <option value="Late" {{ old('status') == 'Late' ? 'selected' : '' }}>
                                                    Late</option>
                                                <option value="Absent" {{ old('status') == 'Absent' ? 'selected' : '' }}>
                                                    Absent</option>
                                                <option value="Leave" {{ old('status') == 'Leave' ? 'selected' : '' }}>
                                                    Leave</option>
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
                                <button type="submit" class="btn btn-success me-3">Create Presence</button>
                                <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('presences.store') }}" method="POST">

                            <div class="card-body">
                                <div class="alert alert-warning">
                                    “You must check in at the appropriate location
                                </div>
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="latitude">Latitude</label>
                                            <input type="text" name="latitude" id="latitude" class="form-control round"
                                                placeholder="Latitude Input...">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="longitude">Longitude</label>
                                            <input type="text" name="longitude" id="longitude"
                                                class="form-control round" placeholder="Longitude Input...">
                                        </div>
                                        <div class="col-sm-12">
                                            <iframe src="" frameborder="0" width="500" height="300"
                                                scrolling="no" marginheight="0" marginwidth="0">

                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success me-3"
                                        id="btn-present">Present</button>
                                    <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to List</a>
                                </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
        const iframe = document.querySelector('iframe');
        const officeLat = -7.7557144;
        const officeLng = 110.390893;
        const treshold = 0.01;

        navigator.geolocation.getCurrentPosition((position) => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            iframe.src = `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                    // COMPARE
                    const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(lng - officeLng, 2));

                    if (distance <= treshold) {
                        alert('You are at the office');
                        document.getElementById('btn-present').removeAttribute('disabled');
                    } else {
                        alert('You are not at the office');
                    }
                })
            }
        })
    </script>
@endsection
