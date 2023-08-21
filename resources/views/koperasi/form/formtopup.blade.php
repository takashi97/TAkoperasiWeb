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
                        <h2 class="fw-bold">Form Top Up</h2>
                  </div>
        </header>
        <!--Header-->

      <!--Content-->
        <form class="form-r" method="POST" action="{{ route('topup.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="input-box-r">
                    <b><label for="name">{{ __('Name') }}</label></b>
                    <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Masukkan nama lengkap" readonly>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                    <div class="input-box-r">
                        <b><label for="jum_topup">{{ __('Jumlah Top Up') }}</label></b>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input id="jum_topup" type="text" name="jum_topup" value="{{ old('jum_topup') }}" class="form-control" placeholder="Masukkan jumlah Top Up" required autocomplete="jum_topup">
                        </div>
                        @error('jum_topup')
                                <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-box-r">
                        <b><label for="t_topup">{{ __('Tanggal Top Up') }}</label></b>
                        <input id="t_topup" type="date" name="t_v" value="{{ old('t_topup') ?? now()->toDateString() }}" placeholder="Masukkan tanggal Top Up" readonly>
                        @error('t_topup')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-box-r">
                    <b><label for="image_topup">{{ __('Foto Bukti Top Up') }}</label>
                        <input class="form-control form-control-lg" id="image_topup" type="file" name="image_topup" placeholder="Upload bukti Top Up" required>
                        @error('image_topup')
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

