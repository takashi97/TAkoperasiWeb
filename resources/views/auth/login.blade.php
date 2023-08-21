@extends('layouts.navbar')
@section('content')
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Registrasi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
    </head>

    <body>
        <section class="container-r">
            <header>Login</header>
            <br>
                        <!--Email-->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-box-r">    
                        <b><label for="email" class="form-label">{{ __('E-Mail Address') }}</label></b>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        <!--Email-->

                        <br>   
                        <!--Password-->    
                        <b><label for="password" class="form-label">{{ __('Password') }}</label></b>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <!--Password-->    

                                <br> 
                        <!--Remember-->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        <!--Remember-->

                        <br>
                        <!--Login&Forgot-->
                                <button type="submit" class="button-r">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        <!--Login&Forgot-->

        </form>
</section>
</body>
</html>

@endsection