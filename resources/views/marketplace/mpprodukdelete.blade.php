 <!-- Navbar -->
 @include('layouts.navbar')
  <!-- Navbar -->

<!doctype html>
<html lang="en">
  <head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/koperasipinjam.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>

<body>
    <section class="container">
        <!--Header-->
        <header class="py-2">
                  <div class="headername text-center">
                        <h2 class="fw-bold">Delete Produk</h2>
                  </div>
        </header>
        <!--Header-->

      <!--Content-->
        <form class="form-r" method="POST" action="{{ route('mpprodukdelete.post', ['identifier' => $product->identifier]) }}" enctype="multipart/form-data">
                @csrf
            @csrf
            @method('POST')
            <button style="color:white; background-color:rgb(88, 56, 250);" type="submit" class="btn buttontambah" role="button" aria-pressed="true" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
        </form>
      <!--Content-->              
    </section>
</body>
</html>

<!--Scripts-->
<script>
</script>
