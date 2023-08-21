
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/produkpagemakanan.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">

    <!--Content-->
    <div class="padding">
          <main class="mt-5 pt-4">
            <div class="container dark-grey-text mt-5">

          <!--Grid row-->
          <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 mb-4">

              <!--Content-->
              
              <div class="p-4">

                <div class="mb-3">
                  <div class="col-md-3 mb-2">
                    <img src="imgs/koperasi/proses/check.png" class="img-fluid" alt="">
                  </div>
                    <h1><b>Ayam Segar</b></h1>
                </div>
                <div class="deskripsiproduk">
                <h4><b>Harga</b></h4>
                </div>

                <p class="lead">
                  <span class="mr-1">
                    <del>Rp. 60.000</del>
                  </span>
                  <span>Rp. 59.000</span>
                </p>

                <div class="deskripsiproduk">
                <h4><b>Deskripsi Produk</b></h4>
                </div>
                <p>100% Ayam segar</p>

                <div class="buttonbawah">
                <form class="d-flex justify-content-left">
                  <!-- Default input -->
                  <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px">
                    <div class="buy-buttons">
                        <a style="color:white; background-color:rgb(88, 56, 250);"
                        href="{{ url('') }}" class="btn buttontambah" role="button" aria-pressed="true"> 
                        Beli</a>
                    </div>
                </form>
                </div>
              
              </div>
              <!--Content-->

            </div>
            <!--Grid column-->

          </div>
          <!--Grid row-->
        </main>
    </div>
    <!--Content-->
                  
    </section>
</body>
</html>

<!--Scripts-->

