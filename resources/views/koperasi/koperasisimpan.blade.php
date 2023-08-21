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
          <h1 class="display-5 fw-bold">Simpan</h1>
        </div>
      </header>
      <!--Header-->

      <!--Content-->
      <div class="border">
        <div class="buttonatas">
          <a 
            style="color:white; background-color:rgb(130, 106, 251); margin-top: 25px; margin-left: 20px;"
            href="{{ url('koperasisimpanform') }}" 
            class="btn buttontambah" 
            role="button" 
            aria-pressed="true"
          >
            <i class="bx bx-money icon"></i> 
            Tambah
          </a>
        </div>
         
        <br>
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
      <!--Content-->
    </section>
  </body>
</html>

<!--Scripts-->