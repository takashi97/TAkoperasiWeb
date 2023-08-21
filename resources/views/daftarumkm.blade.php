@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Registrasi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="{{ asset('/css/register2.css') }}" rel="stylesheet">
	    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section class="container-rm">
	<!-- Dropdown untuk memilih form yang akan ditampilkan -->
	<!-- Container untuk form menggunakan element <section> -->
    <div class="form-1">
    <form method="POST" action="{{ route('daftarumkm.post', ['formType' => 'form1']) }}" id="form1" class="form-rm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="formType" value="form1">
                <header>Form Daftar Member UMKM</header>
                <div class="input-box-rm">
                    <b><label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Masukkan nama lengkap" required autocomplete="name" autofocus>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-box-rm">
                    <label for="alamat_ktp">{{ __('Alamat (Sesuai KTP)') }}</label>
                    <input id="alamat_ktp" type="text" name="alamat_ktp" value="{{ old('alamat_ktp') }}" placeholder="Masukkan alamat sesuai pada KTP" required autocomplete="alamat_ktp">
                    @error('alamat_ktp')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-box-rm">
                    <label for="nik">{{ __('NIK') }}</label>
                    <input id="nik" type="number" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK" required>
                    @error('nik')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-box-rm">
                    <label for="npwp">{{ __('NPWP') }}</label>
                    <input id="npwp" type="string" name="npwp" value="{{ old('npwp') }}" placeholder="Masukkan NPWP" required>
                    @error('npwp')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-box-rm">
                    <label for="image_ktp">{{ __('Foto KTP') }}</label>
                    <input class="form-control form-control-lg" id="image_ktp" type="file" name="image_ktp" placeholder="Upload foto KTP" required>
                    @error('image_ktp')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <button>Submit</button>
            </form>
        </div>      
	</section>

    <script>
    </script>
    </body>
</html>
@endsection