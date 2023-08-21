@include('layouts.navbar')

<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('/css/mainpage.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
      <!--Header-->
      <header class="py-5">
                  <div class="container px-lg-5">
                      <div class="p-4 p-lg-5 text-center">
                          <div class="m-4 m-lg-5">
                              <h1 class="display-5 fw-bold" style="color:white;">Selamat Datang!</h1>
                              <p class="fs-4" style="color:white;">Silahkan pilih fitur yang ingin digunakan
                              </p>
                          </div>
                      </div>
                  </div>
      </header>
      <!--Header-->

      <!--Cards-->
      <div class="container">
        <div class="row gy-3">
          <div class="col-sm">
          <div class="card">
              <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"></div>
              <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasihomeuser') }}">Koperasi</a></h2>
              <h5>Akses fitur simpanan & pinjaman</h5>
              <br>
              <div id="gambar">
              <img style="height:270px; max-height: 330px; max-width:330px; width: 260px;"
               src="imgs/logo/koperasi.svg" class="card-img-top" alt="koperasilogo">
              </div>
              </div>
            </div>
          </div>
          <div class="col-sm">
          <div class="card">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"></div>
              <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('marketplacehome') }}">Marketplace</a></h2>
              <h5>Akses fitur pembelian & penjualan</h5>
              <br>
              <div id="gambar">
              <img style="height:270px; max-height: 330px; max-width:330px; width: 260px;"
              src="imgs/logo/marketplace.svg" class="card-img-top" alt="koperasilogo">
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Cards-->
  </section>
</body>
</html>

<!--Scripts-->

