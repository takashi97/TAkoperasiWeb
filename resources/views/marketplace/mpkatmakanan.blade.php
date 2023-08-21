
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/mpkatmakanan.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
        <!--Header-->
        <div class="judul text-center">
              <h1 style="color:white; margin-bottom: 30px;" class="display-5 fw-bold">Makanan</h1>
        </div>
        <!--Header-->

      <!--Content-->

      <!-- Produk -->
        <div class="container">
        <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-block text-center">
                <div class="card-body">
                    <img src="{{ asset('image_produk/' . $product->image_produk) }}" alt="{{ $product->p_name }}" class="fixedimg">
                    <h2 class="product-name">{{ $product->p_name }}</h2>
                    <p class="product-description">
                    @if (strlen($product->d_produk) > 20)
                        {{ substr($product->d_produk, 0, 20) . '...' }}
                    @else
                        {{ $product->d_produk }}
                    @endif
                    </p>
                    <p class="product-price">Rp. {{ number_format($product->h_produk) }}</p>
                    <div class="product-buttons">
                    <a style="color:white; background-color:rgb(88, 56, 250);"
                        href="{{ route('produkpage', ['identifier' => $product->identifier]) }}" class="btn buttontambah" role="button" aria-pressed="true"> 
                        Beli</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
         @endforeach
        </div>
        </div>
        <!-- Produk -->

      <!--Content-->
                  
    </section>
</body>
</html>

<!--Scripts-->

