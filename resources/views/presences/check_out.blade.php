@extends('layouts.dashboard')
@section('section')
@section('title', 'Check Out')
@section('link', route('presences.index'))
@section('page-title', 'Check Out')
@section('previous-title', 'List Data')
<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('presences.check_out_process', $presence) }}" method="POST">

                    <div class="card-body">
                        <div class="alert alert-warning">
                            “You must check out at the appropriate location
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
                                    <input type="text" name="longitude" id="longitude" class="form-control round"
                                        placeholder="Longitude Input...">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="check_in" class="form-label">Check In</label>
                                        <input type="text" name="check_in" id="check_in"
                                            class="form-control flatpickr-no-config flatpickr-input @error('check_in') is-invalid @enderror"
                                            placeholder="Select Check In.."
                                            value="{{ old('check_in', $presence->check_in) }}" disabled>
                                        @error('check_in')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <iframe src="" frameborder="0" width="500" height="300" scrolling="no"
                                        marginheight="0" marginwidth="0">

                                    </iframe>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success me-3" id="btn-checkout" disabled>Check
                                Out</button>
                            <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                </form>
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
                    document.getElementById('btn-checkout').removeAttribute('disabled');
                } else {
                    alert('You are not at the office');
                }
            })
        }
    })
</script>
@endsection
