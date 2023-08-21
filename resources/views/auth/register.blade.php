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
        <link href="{{ asset('/css/register.css') }}" rel="stylesheet">
    </head>
    <body>
        <section class="container-r">
            <header>Form Registrasi Koperasi</header>
            <form method="POST" action="{{ route('register') }}" class ="form-r" enctype="multipart/form-data">
                 @csrf

                <div class="input-box-r">
                    <b><label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"  placeholder="Masukkan nama lengkap" required autocomplete="name" autofocus>
                        @error('name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                <div class="input-box-r">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email" required autocomplete="email">
                        @error('email')
                            <span>{{ $message }}</span>
                        @enderror
                </div>

                <div class="input-box-r">
                    <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" placeholder="Masukkan password" required autocomplete="new-password">
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                </div>

                <div class="input-box-r">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Masukkan kembali password anda" required autocomplete="new-password">
                </div>


                <div class="column">
                    <div class="input-box-r">
                        <label for="n_telepon">{{ __('Nomor Telepon') }}</label>
                            <input id="n_telepon" type="string" name="n_telepon" value="{{ old('n_telepon') }}" placeholder="Masukkan nomor telepon" required>
                            @error('n_telepon')
                                <span>{{ $message }}</span>
                            @enderror
                    </div>

                    <div class="input-box-r">
                        <label for="t_lahir">{{ __('Tanggal Lahir') }}</label>
                            <input id="t_lahir" type="date" name="t_lahir" value="{{ old('t_lahir') }}" placeholder="Masukkan tanggal lahir" required>
                            @error('t_lahir')
                                <span>{{ $message }}</span>
                            @enderror
                    </div>
                </div>

                <div class="gender-box-r">
                <label for="j_kelamin">{{ __('Jenis Kelamin') }}</label></b>
                <br>
                <select id="j_kelamin" name="j_kelamin" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="male" @if (old('j_kelamin') == 'male') selected @endif>Male</option>
                    <option value="female" @if (old('j_kelamin') == 'female') selected @endif>Female</option>
                </select>
                </div>
                <br>
                <button>Submit</button>
            </form>
        </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>

@endsection