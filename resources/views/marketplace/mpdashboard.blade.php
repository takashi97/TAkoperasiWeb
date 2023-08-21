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
    <!-- Header -->
    <header class="py-5">
        <div class="container">
            <h5 class="display-5">MARKETPLACE</h5>
            <h1 class="display-5 fw-bold">Dashboard</h1>
        </div>
    </header>
    <!-- Header -->

    <!-- Content -->
    <div class="judul5">
        <h5 style="color:white;" class="display-5 fw-bold text-center">Transaksi</h5>
    </div>

    <div class="border">
        <!-- Pembelian -->
        <div class="simpanan">
            <div class="judul4 text-center">
                <h5 class="display-7 fw-bold">Pembelian</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead align="center">
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Alamat</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>
                                @foreach ($order->products as $product)
                                    {{ $product->p_name }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($order->products as $product)
                                    Rp. {{ number_format($product->h_produk, 0, ',', '.') }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($order->products as $product)
                                    {{ $product->pivot->quantity }}<br>
                                @endforeach
                            </td>
                            <td>{{ $order->alamat_kirim }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pembelian -->
    </div>
    <!-- Content -->
</section>
</body>

</html>

<!-- Scripts -->
