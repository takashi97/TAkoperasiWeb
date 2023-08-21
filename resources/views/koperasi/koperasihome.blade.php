
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('/css/koperasihomeuser.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">
    <!--Header-->
    <header class="py-5">
                  <div class="container">
                        <h5 class="display-5">OVERVIEW</h5>
                        <h1 class="display-5 fw-bold">Dashboard</h1>
                  </div>
      </header>
      <!--Header-->

      <!--Content-->

      <!--Cards-->
      <div class="container">
    <div class="row gy-4">
        <div class="col-sm">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center">Simpanan</h5>
                    <p class="card-text text-center">0
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center">Pinjaman</h5>
                    <p class="card-text text-center">0</p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center">Penarikan</h5>
                    <p class="card-text text-center">0</p>
                </div>
            </div>
        </div>
    </div>
</div>   
      <!--Cards-->
    <br>
    <div class="judul3">
        <h5 class="display-5 fw-bold">Approval</h5>
    </div>
    
<div class="border">
    <!-- Topup -->
    <div class="simpanan">
        <div class="judul4 text-center">
            <h5 class="display-7 fw-bold">Top Up Saldo</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Top Up ID</th>
                <th>Status</th>
                <th>Approval</th>
                <th>Bukti Top Up</th>
                </thead>
                <tbody>
                    @foreach ($topups as $topup)
                    <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $topup->id }}</td>
                    <td align="center">{{ $topup->approved ? 'Approved' : 'Pending' }}</td>
                    <td align="center">
                        <form method="POST" action="{{ route('topupapproval.approve', $topup->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="approvebtn" type="submit">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('topupapproval.reject', $topup->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="rejectbtn" type="submit">Reject</button>
                        </form>
                    </td>
                    <td align="center">
                    <img src="{{ asset('image_topup/' . $topup->image_topup) }}" alt="Topup Image" style="width: 100%; object-fit: cover;">
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>  
        </div>   
    <!-- Topup -->

    <!-- Simpanan -->
    <div class="simpanan">
        <div class="judul4 text-center">
            <h5 class="display-7 fw-bold">Simpanan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead align="center">
                <th>No</th>
                <th>Simpanan ID</th>
                <th>Status</th>
                <th>Approval</th>
                </thead>
                <tbody>
                    @foreach ($simpanans as $simpanan)
                    <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $simpanan->id }}</td>
                    <td align="center">{{ $simpanan->approved ? 'Approved' : 'Pending' }}</td>
                    <td align="center">
                        <form method="POST" action="{{ route('simpanapproval.approve', $simpanan->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="approvebtn" type="submit">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('simpanapproval.reject', $simpanan->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="rejectbtn" type="submit">Reject</button>
                        </form>
                    </td>
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
                <th>Pinjaman ID</th>
                <th>Status</th>
                <th>Approval</th>
                </thead>
                <tbody>
                    @foreach ($pinjamans as $pinjaman)
                    <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $pinjaman->id }}</td>
                    <td align="center">{{ $pinjaman->approved ? 'Approved' : 'Pending' }}</td>
                    <td align="center">
                        <form method="POST" action="{{ route('pinjamapproval.approve', $pinjaman->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="approvebtn" type="submit">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('pinjamapproval.reject', $pinjaman->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="rejectbtn" type="submit">Reject</button>
                        </form>
                    </td>
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
                <th>Penarikan ID</th>
                <th>Status</th>
                <th>Approval</th>
                </thead>
                <tbody>
                    @foreach ($penarikans as $penarikan)
                    <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $penarikan->id }}</td>
                    <td align="center">{{ $penarikan->approved ? 'Approved' : 'Pending' }}</td>
                    <td align="center">
                        <form method="POST" action="{{ route('penarikanapproval.approve', $penarikan->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="approvebtn" type="submit">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('penarikanapproval.reject', $penarikan->id) }}">
                        @csrf
                        <button style="color:white; background-color:rgb(130, 106, 251);" class="rejectbtn" type="submit">Reject</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div> 
        </div>   
        <!-- Penarikan -->

      <!--Content-->
      </div>          
    </section>
</body>

</html>

<!--Scripts-->

