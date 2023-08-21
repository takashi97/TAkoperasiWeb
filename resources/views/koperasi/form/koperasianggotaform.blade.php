 <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/koperasipinjam.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>

<body>
    <section class="container">
        <!--Header-->
        <header class="py-2">
                  <div class="headername">
                        <h2 class="fw-bold">Tambah Anggota</h2>
                  </div>
        </header>
        <!--Header-->

      <!--Content-->
        <form class ="form-r">

                <div class="input-box-r">
                    <b><label for="name">Nama Anggota</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"  placeholder="Masukkan nama lengkap" required autocomplete="name" autofocus>
                    </div>

                <div class="input-box-r">
                    <label for="email">E-Mail Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email" required autocomplete="email">
                </div>

                <div class="input-box-r">
                    <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="Masukkan password" required autocomplete="new-password">
                </div>

                <div class="input-box-r">
                    <label for="image_ktp">{{ __('Foto KTP') }}</label>
                        <input class="form-control form-control-lg" id="image_ktp" type="file" name="image_ktp" placeholder="Upload foto KTP" required>
                </div>

                <div class="input-box-r">
                    <label for="email">{{ __('Alamat (Sesuai KTP)') }}</label>
                        <input id="alamat_ktp" type="text" name="alamat_ktp" value="{{ old('alamat_ktp') }}" placeholder="Masukkan alamat sesuai pada KTP" required autocomplete="alamat_ktp">
                </div>

                <br>
                <div class="gender-box-r">
                <label for="j_kelamin">{{ __('Jenis Kelamin') }}</label></b>
                <br>
                <select id="j_kelamin" name="j_kelamin" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="male" @if (old('j_kelamin') == 'male') selected @endif>Male</option>
                    <option value="female" @if (old('j_kelamin') == 'female') selected @endif>Female</option>
                </select>
                </div>

                <button>Submit</button>
            </form>
      <!--Content-->              
    </section>
</body>
</html>

<!--Scripts-->

