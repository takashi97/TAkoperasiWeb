
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/koperasianggota.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
        <!--Header-->
        <header class="py-5">
                  <div class="container">
                        <h5 class="display-5">OVERVIEW</h5>
                        <h1 class="display-5 fw-bold">Laporan</h1>
                  </div>
        </header>
        <!--Header-->
      <!--Content simpanan--> 
      <div class="border">
      <div class="table-responsive">
      <h4><strong>Laporan Simpanan</strong></h4>
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
      <!--Content simpanan-->
      <br>
      <!--Content pinjaman--> 
      <div class="table-responsive">
      <h4><strong>Laporan Pinjaman</strong></h4>
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
      <!--Content pinjaman-->
      <br>
      <!--Content Penarikan--> 
      <div class="table-responsive">
      <h4><strong>Laporan Penarikan</strong></h4>
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
      <!--Content penarikan-->
                  
    </section>
</body>
</html>

<!--Scripts-->

