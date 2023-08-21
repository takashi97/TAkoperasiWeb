
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/mpsellpage.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
        <!--Header-->
        <div class="judulpage text-center">
              <h1 style="color:white;" class="display-4 fw-bold">Sell Page</h1>
        </div>
        <!--Header-->

      <!--Content-->

      <!-- Kategori -->

      <!-- Add Product -->
      <div class="juduladd text-left">
              <h1 style="color:white;" class="display-5 fw-bold">Add Product</h1>
        </div>
        <div class="container">
            <div class="row gy-4">

                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                                <div class="img">
                                    <img src="imgs/mp/sellpage/plus.png" alt="Product Name">
                                </div>
                                    <div class="addbutton">
                                    <a style="color:white; background-color:rgb(88, 56, 250);"
                                    href="{{ url('mpsellform') }}" class="btn buttontambah" role="button" aria-pressed="true"> 
                                    Add Product</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                                <div class="img">
                                    <img src="imgs/mp/sellpage/plus.png" alt="Product Name">
                                </div>
                                    <div class="addbutton">
                                    <a style="color:white; background-color:rgb(88, 56, 250);"
                                    href="{{ url('mpsellform') }}" class="btn buttontambah" role="button" aria-pressed="true"> 
                                    Add Product</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                                <div class="img">
                                    <img src="imgs/mp/sellpage/plus.png" alt="Product Name">
                                </div>
                                    <div class="addbutton">
                                    <a style="color:white; background-color:rgb(88, 56, 250);"
                                    href="{{ url('mpsellform') }}" class="btn buttontambah" role="button" aria-pressed="true"> 
                                    Add Product</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
        <!-- Add Product -->

        <!-- Uploaded Product -->
        <div class="judulup text-left">
              <h1 style="color:white;" class="display-5 fw-bold">Uploaded</h1>
        </div>
            <div class="container">
                <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-4 mb-2">
                            <div class="card h-100">
                                <div class="card-block text-center">
                                    <div class="card-body">
                                        <img src="{{ asset('image_produk/'.$product->image_produk) }}" alt="{{ $product->p_name }}" class="fixedimg">
                                        <h2 class="product-name">{{ $product->p_name }}</h2>
                                        <p class="name">{{ ucwords($product->user->name) }}</p>
                                        <p class="product-kategori">{{ ucfirst($product->j_produk) }}</p>
                                        <p class="product-price">Rp. {{ number_format($product->h_produk, 0, '.', '.') }}</p>
                                        <div class="product-buttons">
                                        <a style="color:white; background-color:rgb(88, 56, 250);" href="{{ route('mpprodukedit', ['identifier' => $product->identifier]) }}" class="btn buttontambah" role="button" aria-pressed="true">Edit</a>
                                            <a style="color:white; background-color:rgb(88, 56, 250);" href="{{ route('mpprodukdelete', ['identifier' => $product->identifier]) }}" class="btn buttontambah" role="button" aria-pressed="true">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
        <!-- Uploaded Product -->

      <!--Content-->
                  
    </section>
</body>
</html>

<!--Scripts-->

