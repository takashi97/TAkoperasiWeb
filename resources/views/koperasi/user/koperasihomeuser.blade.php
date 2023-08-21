
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/koperasihomeuserpage.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
        <!--Header-->
    <header class="py-5">
                  <div class="container">
                        <h5 class="display-5 fw-bold" style="color:black;">Koperasi</h5>
                        <h1 class="display-5 fw-bold" style="color:white;">User Dashboard</h1>
                  </div>
      </header>
      <!--Header-->

      <!--Content-->

      <!-- Quick access -->
      <div class="judul text-center">
              <h1 style="color:white;" class="display-5 fw-bold">Quick Access</h1>
        </div>
        <div class="container">
            <div class="row gy-4">

                <div class="col-md-4 mb-6">
                    <div class="card h-100">
                        <div class="card-block text-center">
                            <div class="card-body">
                            <br>
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasisimpanform') }}">Simpan</a></h2>
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
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasipinjamform') }}">Pinjam</a></h2>
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
                            <h2><a class="fs-4 fw-bold" style="color:black;" href="{{ url('koperasipenarikanform') }}">Penarikan</a></h2>
                            <img style="margin-bottom: 10%;" src="imgs/koperasi/home/penarikan.png" alt="Product Name">
                            </div>
                        </div>
                    </div>
                </div>

          </div>
        </div>
        <!-- Quick access -->

    <div class="info">
    <div class="judul2 text-center">
              <h1 style="color:white;" class="display-5 fw-bold">Transaksi</h1>
        </div>
    <div class="border">
    <!-- Simpanan -->
    <div class="simpanan">
        <div class="judul4 text-center">
            <h5 class="display-7 fw-bold">Simpanan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead align="center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nasabah</th>
                    <th>Jenis Simpanan</th>
                    <th>Jumlah Simpanan</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @php $no = 0 @endphp
                    @foreach($simpanans as $simpanan)
                        <tr>
                        <td align="center">{{ ++$no }}</td>
                        <td align="center">{{ $simpanan->t_simpanan }}</td>
                        <td align="center">{{ ucwords($simpanan->name) }}</td>
                        <td align="center">{{ ucfirst($simpanan->j_simpanan) }}</td>
                        <td align="center">{{ $simpanan->jum_simpanan }}</td>
                        <td align="center">{{ $simpanan->approved }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>  
        </div>   
        <!-- Simpanan -->

        <!-- Pinjaman -->
        <div class="pinjaman">
            <div class="judul4 text-center">
            <h5 class="display-7 fw-bold">Pinjaman</h5>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Durasi Pinjaman</th>
                <th>Jumlah Pinjaman</th>
                <th>Status</th>
                </thead>
                <tbody>
                    @php $no = 0 @endphp
                    @foreach($pinjamans as $pinjaman)
                    <tr>
                    <td align="center">{{ ++$no }}</td>
                    <td align="center">{{ $pinjaman->t_pinjaman }}</td>
                    <td align="center">{{ ucwords($pinjaman->name) }}</td>
                    <td align="center">{{ $pinjaman->dur_pinjaman }}</td>
                    <td align="center">{{ $pinjaman->jum_pinjaman }}</td>
                    <td align="center">{{ $pinjaman->approved }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div> 
        </div> 
        <!-- Pinjaman -->

        <!-- Penarikan -->
        <div class="penarikan">
            <div class="judul4 text-center">
            <h5 class="display-7 fw-bold">Penarikan</h5>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
                <th>Jumlah Penarikan</th>
                <th>Status</th>
                </thead>
                <tbody>
                    @php $no = 0 @endphp
                    @foreach($penarikans as $penarikan)
                    <tr>
                    <td align="center">{{ ++$no }}</td>
                    <td align="center">{{ $penarikan->t_penarikan}}</td>
                    <td align="center">{{ ucwords($penarikan->name) }}</td>
                    <td align="center">{{ $penarikan->jum_penarikan }}</td>
                    <td align="center">{{ $penarikan->approved }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div> 
        </div>   
        <!-- Penarikan -->
      </div>  
    </div>
      <!--Content-->
                  
    </section>
</body>
</html>

<!--Scripts-->

