<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name') }}</title>

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
                    <img src="{{ asset('img/hris-logo2.png') }}" alt="Logo" class="img-fluid w-50 h-100">
                </div>

                <!-- Card -->
                <div class="card shadow-lg border-0 bg-dark-subtle">

                    <div class="card-body p-5">
                          <div class="text-center">
                            <i class="bi bi-shield-lock text-primary display-4 mb-3"></i>
                            <h2 class="fw-bold text-white mb-3">
                                Confirm Password
                            </h2>
                        </div>

               <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
                                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>
                            @csrf
                            <div class="form-group position-relative has-icon-left mb-4">

                                <input type="password" name="password" id="password" required autocomplete="current-password"
                                    class="form-control form-control-xl" placeholder="Password">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm mb-3 rounded-3">
                                <i class="bi bi-send-fill me-2"></i>
                                Confirm
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
