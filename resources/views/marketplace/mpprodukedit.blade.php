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
                  <div class="headername text-center">
                        <h2 class="fw-bold">Edit Produk</h2>
                  </div>
        </header>
        <!--Header-->

      <!--Content-->
        <form class="form-r" method="POST" action="{{ route('mpprodukedit.post', ['identifier' => $product->identifier]) }}" enctype="multipart/form-data">
                @csrf
                <div class="input-box-r">
                    <b><label for="p_name">{{ __('Nama Produk') }}</label></b>
                    <input id="p_name" type="text" name="p_name" required autocomplete="" autofocus value="{{ old('p_name', $product->p_name) }}">
                    @error('p_name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-box-r">
                    <b><label for="image_produk">{{ __('Foto Produk') }}</label></b>
                    <input class="form-control form-control-lg" id="image_produk" type="file" name="image_produk" placeholder="Upload image produk" required>
                    @error('image_produk')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="simpanan-box-r">
                    <b><label for="j_produk">{{ __('Kategori Produk') }}</label></b>
                    <br>
                    <select id="j_produk" name="j_produk" required>
                        <option value="">-- Pilih Kategori Produk --</option>
                        <option value="makanan" @if ($product->j_produk == 'makanan') selected @endif>Makanan</option>
                        <option value="pakaian" @if ($product->j_produk == 'pakaian') selected @endif>Pakaian</option>
                        <option value="aksesoris" @if ($product->j_produk == 'aksesoris') selected @endif>Aksesoris</option>
                    </select>
                    @error('j_produk')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                    <div class="input-box-r">
                        <b><label for="h_produk">{{ __('Harga Produk') }}</label></b>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input id="h_produk" type="text" value="{{ $product->h_produk }}" name="h_produk" value="" class="form-control" placeholder="Masukkan harga produk" required autocomplete="h_produk">
                        </div>
                        @error('h_produk')
                                <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="simpanan-box-r">
                    <b><label for="k_produk">{{ __('Kondisi Produk') }}</label></b>
                    <br>
                    <select id="k_produk" name="k_produk" required>
                        <option value="">-- Pilih Kondisi Produk --</option>
                        <option value="baru" {{ $product->k_produk == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="bekas" {{ $product->k_produk == 'bekas' ? 'selected' : '' }}>Bekas</option>
                    </select>
                      @error('k_produk')
                        <span>{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="input-box-r">
                        <b><label for="s_produk">{{ __('Stok Produk') }}</label></b>
                        <div class="input-group">
                            <input id="s_produk" type="text" value="{{ $product->s_produk }}" name="s_produk" value="" class="form-control" placeholder="Masukkan stok produk" required autocomplete="s_produk">
                        </div>
                        @error('s_produk')
                                <span>{{ $message }}</span>
                        @enderror
                    </div>    

                    <div class="input-box-r">
                        <b><label for="b_produk">{{ __('Berat Produk') }}</label></b>
                        <div class="input-group">
                            <input id="b_produk" type="text" value="{{ $product->b_produk }}" name="b_produk" value="" class="form-control" placeholder="Masukkan berat produk" required autocomplete="b_produk">
                            <span class="input-group-text">Kg</span>
                        </div>
                        @error('b_produk')
                                <span>{{ $message }}</span>
                        @enderror
                    </div> 

                    <div class="input-box-r">
                        <b><label for="d_produk">{{ __('Deskripsi Produk') }}</label></b>
                        <div class="input-group">
                            <textarea id="d_produk" name="d_produk" rows="10" class="form-control" placeholder="Masukkan Deskripsi produk" required autocomplete="d_produk" style="resize:none;">{{ $product->d_produk }}</textarea>
                        </div>
                        @error('d_produk')
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
    $('#h_produk').on('keyup', function() {
        var num = $(this).val().replace(/\D/g, '');
        var formatted = num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        $(this).val(formatted);
    }).on('blur', function() {
        var num = $(this).val().replace(/\D/g, '');
        $(this).val(num);
    });
});
</script>
