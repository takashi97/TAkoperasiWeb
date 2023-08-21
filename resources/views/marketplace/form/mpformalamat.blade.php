 <!-- Navbar -->
 @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/koperasipinjam.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

<body>
    <section class="container">
        <!--Header-->
        <header class="py-2">
                  <div class="headername">
                        <h2 class="fw-bold">Form Alamat</h2>
                  </div>
        </header>
        <!--Header-->

      <!--Content-->
        <form class="form-r" method="POST" action="{{ route('topup.post') }}">
                @csrf
                <div class="input-box-r">
                    <b><label for="name">{{ __('Nama Penerima') }}</label></b>
                    <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Masukkan nama lengkap" required autocomplete="name" autofocus>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-box-r">
                    <b><label for="name">{{ __('No Telepon Penerima') }}</label></b>
                    <input id="name" type="text" name="name" value="" placeholder="Masukkan nomor telepon lengkap" required autocomplete="name" autofocus>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-box-r">
                        <b><label for="t_topup">{{ __('Alamat Pengiriman') }}</label></b>
                        <input id="t_topup" type="" name="t_v" value="" placeholder="Masukkan alamat pengiriman lengkap" readonly>
                        @error('t_topup')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-box-r">
                        <b><label for="t_topup">{{ __('Kota') }}</label></b>
                        <input id="t_topup" type="" name="t_v" value="" placeholder="Masukkan lokasi kota" readonly>
                        @error('t_topup')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-box-r">
                        <b><label for="t_topup">{{ __('Kode Pos') }}</label></b>
                        <input id="t_topup" type="" name="t_v" value="" placeholder="Masukkan kode pos" readonly>
                        @error('t_topup')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                <button>Submit</button>
            </form>
      <!--Content-->              
    </section>
</body>
</html>

<!--Scripts-->
<script>
$(document).ready(function() {
    $('#jum_topup').on('keyup', function() {
        var num = $(this).val().replace(/\D/g, '');
        var formatted = num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        $(this).val(formatted);
    }).on('blur', function() {
        var num = $(this).val().replace(/\D/g, '');
        $(this).val(num);
    });
});
</script>

