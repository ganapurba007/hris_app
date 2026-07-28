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
                <form action="{{ route('presences.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @include('presences._form')
                    </div>
                    <div class="card-footer">
                        @if (session('role') == 'HR' || (Auth::user()->employee && Auth::user()->employee->role && Auth::user()->employee->role->title == 'HR'))
                            <button type="submit" class="btn btn-success me-2">Create Presence</button>
                        @else
                            <button type="submit" class="btn btn-success me-2" id="btn-present" disabled>Present</button>
                        @endif
                        <a href="{{ route('presences.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if (!(session('role') == 'HR' || (Auth::user()->employee && Auth::user()->employee->role && Auth::user()->employee->role->title == 'HR')))
<script>
    const iframe = document.querySelector('iframe');
    const officeLat = -7.7557144;
    const officeLng = 110.390893;
    const treshold = 0.01;

    document.addEventListener('DOMContentLoaded', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                if (iframe) {
                    iframe.src = `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
                }

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(lng - officeLng, 2));

                if (distance <= treshold) {
                    document.getElementById('btn-present')?.removeAttribute('disabled');
                } else {
                    alert('You are not at the office location');
                }
            });
        }
    });
</script>
@endif
@endsection
