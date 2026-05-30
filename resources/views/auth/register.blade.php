<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name' ?? 'Laravel') }}</title>
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
                    <h1 class="auth-title">Register</h1>
                    <p class="auth-subtitle mb-3">Input your data to register to our website.</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="name" id="name" :value="old('name')" required
                                autofocus autocomplete="name" class="form-control form-control-xl"
                                placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" id="email" :value="old('email')" required
                                autocomplete="username" class="form-control form-control-xl" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">

                            <input type="password" name="password" required autocomplete="new-password"
                                class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">

                            <input type="password" name="password_confirmation" required autocomplete="new-password"
                                class="form-control form-control-xl" placeholder="Confirm Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Register</button>
                    </form>
                    <div class="text-center mt-2 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}"
                                class="font-bold">Log
                                in</a>.</p>
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
