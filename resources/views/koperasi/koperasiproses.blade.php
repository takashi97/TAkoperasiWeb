
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/koperasiproses.css') }}" rel="stylesheet">
  </head>

<body>
    <section class="container">

    <!--Content-->
    <div class="border">
          <div class="prosesimg">
            <img src="imgs/koperasi/proses/check.png" class="img-fluid" alt="">
          </div>

          <!--Body-->
          <div class="isi">
            <h1><b>Permintaan Anda Telah Diproses!</b></h1>
          </div>
          <!--Body-->

          <!--Button-->
          <div class="product-buttons">
            <a style="color:white; background-color:rgb(88, 56, 250);"
            href="{{ url('') }}" class="btn buttontambah" role="button" aria-pressed="true"> 
            Kembali ke home</a>
          </div>
          <!--Button-->
    </div>
    <!--Content-->
           
    </section>
</body>
</html>

<!--Scripts-->

