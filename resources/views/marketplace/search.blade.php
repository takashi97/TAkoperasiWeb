  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/search.css') }}" rel="stylesheet">
  </head>

<body>
  <!--Header-->
        <div class="judul text-center">
              <h1 style="color:white; margin-bottom: 30px;" class="display-6 fw-bold">Search Results for "{{ $query }}"</h1>
        </div>
  <!--Header-->

  <!--Content-->
  <section class="container">
    @if ($searchResults->isEmpty())
      <p>No results found.</p>
    @else
      <div class="row">
        @foreach ($searchResults as $result)
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="card-block text-center">
                <div class="card-body">
                  <img src="{{ asset('image_produk/' . $result->image_produk) }}" alt="{{ $result->p_name }}" class="fixedimg">
                  <h2 class="product-name">{{ $result->p_name }}</h2>
                  <p class="product-description">
                    @if (strlen($result->d_produk) > 20)
                      {{ substr($result->d_produk, 0, 20) . '...' }}
                    @else
                      {{ $result->d_produk }}
                    @endif
                  </p>
                  <p class="product-price">Rp. {{ number_format($result->h_produk) }}</p>
                  <div class="product-buttons">
                    <a style="color:white; background-color:rgb(88, 56, 250);"
                      href="{{ route('produkpage', ['identifier' => $result->identifier]) }}"
                      class="btn buttontambah" role="button" aria-pressed="true">Beli</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </section>
  <!--Content-->

</body>
</html>