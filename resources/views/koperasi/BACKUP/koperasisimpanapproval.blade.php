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
          <h5 class="display-5">APPROVAL</h5>
          <h1 class="display-5 fw-bold">Simpan1</h1>
        </div>
      </header>
      <!--Header-->

      <!--Content-->
      <div class="border">
        <div class="buttonatas">
        </div>
         
        <br>
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
      <!--Content-->
    </section>
  </body>
</html>