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
          <h5 class="display-5">Top Up</h5>
          <h1 class="display-5 fw-bold">Saldo</h1>
        </div>
      </header>
      <!--Header-->

      <!--Content-->
      <div class="border">
        <div class="judultopup">
            <h4>Riwayat Top Up</h4>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead align="center">
              <th>No</th>
              <th>Tanggal</th>
              <th>Nasabah</th>
              <th>Jumlah Top Up</th>
              <th>Bukti Top Up</th>
              <th>Status</th>
            </thead>
            <tbody>
              @php $no = 0 @endphp
              @foreach($topups as $topup)
                <tr>
                  <td align="center">{{ ++$no }}</td>
                  <td align="center">{{ $topup->t_topup }}</td>
                  <td align="center">{{ ucwords($topup->name) }}</td>
                  <td align="center">{{ $topup->jum_topup }}</td>
                  <td align="center">
                  <img src="{{ asset('image_topup/' . $topup->image_topup) }}" alt="Topup Image" style="max-width: 40%; height: auto;">
                  </td>
                  <td align="center">{{ $topup->approved }}</td>
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