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
                        <h2 class="fw-bold">Form Simpanan</h2>
                  </div>
        </header>
        <!--Header-->

      <!--Content-->
        <form class="form-r" method="POST" action="{{ route('simpan.post') }}">
                @csrf
                <div class="input-box-r">
                    <b><label for="name">{{ __('Name') }}</label></b>
                    <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Masukkan nama lengkap" required autocomplete="name" readonly>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                    <div class="simpanan-box-r">
                    <b><label for="j_simpanan">{{ __('Jenis Simpanan') }}</label></b>
                    <br>
                      <select id="j_simpanan" name="j_simpanan" required>
                          <option value="">-- Pilih Jenis Simpanan --</option>
                          <option value="wajib" @if (old('j_simpanan') == 'wajib') selected @endif>Wajib</option>
                          <option value="pokok" @if (old('j_simpanan') == 'pokok') selected @endif>Pokok</option>
                          <option value="sukarela" @if (old('j_simpanan') == 'sukarela') selected @endif>Sukarela</option>
                      </select>
                      @error('j_simpanan')
                        <span>{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="input-box-r">
                        <b><label for="jum_simpanan">{{ __('Jumlah Simpanan') }}</label></b>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input id="jum_simpanan" type="text" name="jum_simpanan" value="{{ old('jum_simpanan') }}" class="form-control" placeholder="Masukkan jumlah simpanan" required autocomplete="jum_simpanan">
                        </div>
                        @error('jum_simpanan')
                                <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-box-r">
                        <b><label for="t_simpanan">{{ __('Tanggal Simpan') }}</label></b>
                        <input id="t_simpanan" type="date" name="t_simpanan" value="{{ old('t_simpanan') ?? now()->toDateString() }}" placeholder="Masukkan tanggal lahir" readonly>
                        @error('t_simpanan')
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
    $('#jum_simpanan').on('keyup', function() {
        var num = $(this).val().replace(/\D/g, '');
        var formatted = num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        $(this).val(formatted);
    }).on('blur', function() {
        var num = $(this).val().replace(/\D/g, '');
        $(this).val(num);
    });
});
</script>
