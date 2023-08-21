
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/produkpage.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
    
        <!--Header-->
        <div class="judul text-center">
              <h1 style="color:white;" class="display-5 fw-bold">Produk Page</h1>
        </div>
        <!--Header-->

          <!--Content-->
          <main class="mt-5">
            <div class="padding">
              
              <div class="container">
                <div class="row">
                  <!--IMG-->
                  <div class="col-md-6 mb">
                  <img src="{{ asset('image_produk/'.$product->image_produk) }}" alt="{{ $product->p_name }}" class="fixedimg">
                  </div>
                  <!--IMG-->

                  <!--DESC-->
                  <div class="col-md-6 mb">

                    <div class="judulproduk">
                    <h1><b>{{ ucfirst($product->p_name) }}</b></h1>
                    </div>

                    <div class="hargaproduk">
                    <h4><b>Harga</b></h4>
                    <span>Rp. {{ number_format($product->h_produk, 0, '.', '.') }}</span>
                    </div>

                    <div class="deskripsiproduk">
                    <h4><b>Deskripsi Produk</b></h4>
                    <p>{{ ucfirst($product->d_produk) }}</p>
                    </div>

                    <div class="stokproduk">
                    <h4><b>Stok Produk</b></h4>
                    <p>{{ ucwords($product->s_produk) }}</p>
                    </div>

                    <div class="penjual">
                    <h4><b>Penjual</b></h4>
                    <p>{{ ucwords($product->user->name) }}</p>
                    </div>

                    <div class="buttoncart">
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="button-container">
                                <button style="color:white; background-color:rgb(88, 56, 250);" class="btn btn-primary" type="submit">Add to Cart</button>
                                @if ($errors->any())
                                    <div class="error-message">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                  <!--DESC-->
                </div>
              </div>
            </div>
          </main>
          <!--Content-->          
    </section>
</body>
</html>

<!--Scripts-->

