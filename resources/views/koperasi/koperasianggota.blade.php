
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
                        <h1 class="display-5 fw-bold">Anggota</h1>
                  </div>
        </header>
        <!--Header-->
      
      <!--Content-->
      <div class="border">
        
      <div class="buttonatas">
      <a 
      style="color:white; background-color:rgb(130, 106, 251); margin-top: 25px; margin-left: 20px;"
      href="{{ url('koperasianggotaform') }}" class="btn buttontambah" role="button" aria-pressed="true">
      <i class="bx bx-face icon"></i> 
      Tambah Anggota
      </a>
    </div>
       
      <br>
      <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead align="center">
              <th>No</th>
              <th>Nama Nasabah</th>
              <th>Email Nasabah</th>
              <th>Alamat</th>
              <th>Nomor Telepon</th>
              <th>Role</th>
            </thead>
            <tbody>
              @php $no = 0 @endphp
              @foreach($users as $user)
                <tr>
                  <td align="center">{{ ++$no }}</td>
                  <td align="center">{{ ucwords($user->name) }}</td>
                  <td align="center">{{ ($user->email) }}</td>
                  <td align="center">{{ $user->alamat_ktp }}</td>
                  <td align="center">{{ $user->n_telepon }}</td>
                  <td align="center">{{ ucfirst($user->level) }}</td>
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

