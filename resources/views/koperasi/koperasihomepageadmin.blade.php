
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
              <h1 style="color:white; margin-bottom: 10%;" class="display-5 fw-bold">Koperasi</h1>
        </div>
        <!--Header-->

      <!--Content-->

      <!-- Rekomendasi -->
        <div class="container">
            <div class="row gy-4">

                <div class="col-md-4 mb-6">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                            <br>
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasihome') }}">Dashboard</a></h2>
                            <img style="margin-bottom: 10%;" src="imgs/koperasi/home/dashboard.png" alt="Product Name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-6">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                            <br>
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasianggota') }}">Anggota</a></h2>
                            <img style="margin-bottom: 10%;" src="imgs/koperasi/home/member.png" alt="Product Name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-6">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                            <br>
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasisimpan') }}">Simpan</a></h2>
                            <img style="margin-bottom: 10%;" src="imgs/koperasi/home/simpan.png" alt="Product Name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-6">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                            <br>
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasipinjam') }}">Pinjam</a></h2>
                            <img style="margin-bottom: 10%;" src="imgs/koperasi/home/pinjam.png" alt="Product Name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-6">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                            <br>
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasipenarikan') }}">Penarikan</a></h2>
                            <img style="margin-bottom: 10%;" src="imgs/koperasi/home/penarikan.png" alt="Product Name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-6">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                            <br>
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasilaporan') }}">Laporan</a></h2>
                            <img style="margin-bottom: 10%;" src="imgs/koperasi/home/laporan.png" alt="Product Name">
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
        <!-- Rekomendasi -->

      <!--Content-->
                  
    </section>
</body>
</html>

<!--Scripts-->

