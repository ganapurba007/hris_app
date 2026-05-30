<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - {{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('img/hris-icon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/hris-icon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('template/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/compiled/css/auth.css') }}">
</head>

<body>

    <script src="{{ asset('template/assets/static/js/initTheme.js') }}"></script>

    <div id="auth">
        <div class="row min-vh-100 justify-content-center align-items-center m-0">

            <div class="col-lg-5 col-md-8 col-11">

                <!-- Logo -->
                <div class="text-center">
                    <img src="{{ asset('img/hris-logo2.png') }}"
                        alt="Logo"
                        class="img-fluid w-50 h-100">
                </div>

                <!-- Card -->
                <div class="card shadow-lg border-0 bg-dark-subtle">

                    <div class="card-body p-5">

                        <!-- Icon -->
                        <div class="text-center">
                                <i class="bi bi-envelope-check-fill text-primary display-4"></i>

                            <h2 class="fw-bold text-white mb-3">
                                Email Verification
                            </h2>

                            <p class="text-light-emphasis mb-3 lh-lg">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </p>
                        </div>

                        <!-- Alert -->
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success border-0 shadow-sm">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <!-- Resend Verification -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <button type="submit"
                                class="btn btn-primary btn-lg w-100 shadow-sm mb-3 rounded-3">
                                <i class="bi bi-send-fill me-2"></i>
                                Resend Verification Email
                            </button>
                        </form>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="btn btn-outline-light btn-lg w-100 rounded-3">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Log Out
                            </button>
                        </form>

                    </div>
                </div>



            </div>

        </div>
    </div>

</body>

</html>