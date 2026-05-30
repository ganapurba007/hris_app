<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name' ?? 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/hris-icon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/hris-icon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('template/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('template/assets/static/js/initTheme.js') }}"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <a href="#"><img src="{{ asset('img/hris-logo2.png') }}" alt="Logo"
                            class="w-50 h-100"></a>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="email" id="email" name="email" class="form-control form-control-xl"
                                placeholder="Email" :value="old('email')" required autocomplete="username">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" id="password" name="password" required
                                autocomplete="current_password" class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" id="remember_me" name="remeber_me">
                            <label class="form-check-label text-gray-600" for="remember_me">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Log in</button>
                    </form>
                    <div class="text-center mt-3 text-lg fs-4">
                        {{-- <p class="text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold">Register</a>.
                        </p> --}}
                        @if (Route::has('password.request'))
                            <p><a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>
