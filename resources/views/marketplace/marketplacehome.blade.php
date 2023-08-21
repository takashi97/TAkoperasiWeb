
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/marketplace.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
        <!--Header-->
        <div class="judul text-center">
              <h1 style="color:white;" class="display-5 fw-bold">Marketplace</h1>
        </div>
        <!--Header-->

      <!--Content-->

      <!--Carousell-->
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imgs/mp/caro.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="imgs/mp/caro.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="imgs/mp/caro.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br>
<br>
    <!--Carousell-->

      <!-- Kategori -->
      <div class="judul text-center">
              <h2 style="color:white;" class="fw-bold">KATEGORI</h2>
        </div>
      <div class="container">
        <div class="row gy-4">
            <div class="col-sm">
                <div class="card h-100">
                    <img src="imgs/mp/katimg/makanan.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                    <h2><a class="fs-4" style="color:black;" href="{{ url('mpkatmakanan') }}">Makanan</a></h2>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card h-100">
                    <img src="imgs/mp/katimg/pakaian.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                    <h2><a class="fs-4" style="color:black;" href="{{ url('mpkatpakaian') }}">Pakaian</a></h2>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card h-100">
                    <img src="imgs/mp/katimg/aksesoris.jpg" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                    <h2><a class="fs-4" style="color:black;" href="{{ url('mpkataksesoris') }}">Aksesoris</a></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
      <!-- Kategori -->

      <!-- Rekomendasi -->
        <div class="judul text-center">
          <h2 style="color:white;" class="fw-bold">TERBARU</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
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
        <!-- Rekomendasi -->

      <!--Content-->
                  
    </section>
</body>
</html>

<!--Scripts-->

