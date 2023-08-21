<!-- Navbar -->
@include('layouts.navbar')
<!-- Navbar -->

<!doctype html>
<html lang="en">
<head>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <link href="{{ asset('/css/checkoutpage.css') }}" rel="stylesheet">
</head>

<body>
<section class="container">
    <!--Header-->
    <div class="judul text-left">
        <h1 style="color:white;" class="display-5 fw-bold">Checkout</h1>
    </div>
    <!--Header-->

    <!--Content-->
    <main class="mt-2 pt-4">
        <div class="padding">
            <div class="container dark-grey-text">
                <div class="row">
                    <!--Left section -->
                    <div class="col-md-8 mb-4">
                        <p style="font-weight:bold;"> Alamat Pengiriman </p>
                        <hr>

                        <p style="font-weight:bold;">{{ ucwords($buyer->name) }}</p>
                        <p style="color:gray;">{{ $buyer->n_telepon }}</p>

                        <hr>
                        <form method="POST" action="{{ route('checkoutpage.store') }}">
                            @csrf
                            <input type="text" class="form-control" id="alamat_kirim" name="alamat_kirim"
                                placeholder="Masukkan Alamat"
                                style="color:black; background-color:white; border: 2px solid black;">
                            <hr>
                            <input type="hidden" name="user_id" value="{{ $buyer->id }}">
                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                            <p style="font-weight:bold;"> Nama Penjual</p>
                            <p style="font-weight:bold;"> {{ ucwords($seller->name) }}</p>


                            @foreach ($cart->products as $product)
                                <!-- Left Left Section -->
                                    <div class="col-sm">

                                        <p style="color:gray;">{{ $product->p_name }}</p>
                                        <b><p style="color:black;"> Quantity :</b>{{ $product->pivot->quantity }}</p>
                                        <p style="color:gray;"> Berat :  {{ $product->b_produk }} Kg</p>
                                        <p class="lead">
                                            <span class="mr-1"
                                                style="color:gray;font-size:16px;">Rp. {{ number_format($product->h_produk * $product->pivot->quantity, 0, '.', '.') }}</span>
                                        </p>
                                    </div>

                                    <!-- Right Left Section -->
                                    <hr>
                                    <div style="clear: both;"></div>
                            @endforeach
                            <div class="col-sm">
                                <p style="font-weight:bold;">Pilih Jenis Pengiriman</p>
                                <div class="jenis-pengiriman">
                                    @foreach($shippings as $shipping)
                                        <div>
                                            <input type="radio" class="jp-input" name="shipping_id"
                                                value="{{ $shipping->id }}"
                                                data-shipping-cost="{{ $shipping->shipping_cost }}">
                                            <label>{{ $shipping->shipping_method }} (Rp. {{ number_format($shipping->shipping_cost, 0, '.', '.') }})</label>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                            <hr>
                            <!-- Right Section -->
                            <div class="col-md-4 mb-4">
                                <p style="font-weight:bold;">Ringkasan Belanja</p>
                                <hr>
                                <div id="textbox">
                                    <p class="totalleft">Total Harga ({{ $cart->products->count() }} Produk)</p>
                                    <p class="totalright">Rp. {{ number_format($cart->getTotalPrice(), 0, '.', '.') }}</p>
                                </div>
                                <div style="clear: both;"></div>
                                <hr>
                                <div id="textbox2">
                                    <p style="font-weight:bold;" class="totalleft2">Total Tagihan</p>
                                    @if ($isMember)
                                        @php
                                            $discountedPrice = $cart->getTotalPrice() * 0.1;
                                            $maxDiscount = 20000;
                                            $totalBill = $discountedPrice > $maxDiscount ? $cart->getTotalPrice() - $maxDiscount : $cart->getTotalPrice() - $discountedPrice;
                                        @endphp
                                        <p style="font-weight:bold;" class="totalright2">
                                            Rp. {{ number_format($totalBill, 0, ',', '.') }}
                                            <span style="color: red; font-size: 14px;">(10% discount applied with a maximum discount of Rp. {{ number_format($maxDiscount, 0, ',', '.') }})</span>
                                        </p>
                                    @else
                                        <p style="font-weight:bold;" class="totalright2">
                                            Rp. {{ number_format($cart->getTotalPrice(), 0, ',', '.') }}
                                        </p>
                                    @endif
                                    <input type="hidden" name="t_tagihan" id="totalTagihan" value="{{ $cart->getTotalPrice() }}">
                                </div>
                                <div style="clear: both;"></div>
                                <br>
                                <div class="button-container">
                                    <button type="submit" style="color:white; background-color:rgb(88, 56, 250);display: inline-block; width: 100%;"
                                        class="btn buttonpembayaran" role="button" aria-pressed="true">
                                        Pembayaran</button>
                                        @if ($errors->any())
                                            <div class="error-message">
                                                @foreach ($errors->all() as $error)
                                                    {{ $error }}
                                                @endforeach
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Content-->

</section>
</body>
</html>

<script>
    var radioButtons = document.querySelectorAll('.jp-input');
    var totalBillElement = document.querySelector('.totalright2');
    var totalTagihanInput = document.querySelector('#totalTagihan');
    var originalTotalPrice = parseFloat(totalTagihanInput.value);
    var isMember = {!! json_encode($isMember) !!};
    var discount = 0.1; // 10% discount rate
    var maxDiscount = 20000; // Maximum discount amount

    radioButtons.forEach(function (radioButton) {
        radioButton.addEventListener('change', function () {
            var selectedShippingCost = parseFloat(this.dataset.shippingCost);
            var totalBill;
            var discountedPrice;

            if (isMember) {
                discountedPrice = originalTotalPrice * discount;
                if (discountedPrice > maxDiscount) {
                    discountedPrice = maxDiscount;
                } else {
                    discountedPrice = discountedPrice;
                }
            }

            totalBill = originalTotalPrice - discountedPrice || originalTotalPrice;
            totalBill += selectedShippingCost;

            totalBillElement.innerHTML = 'Rp. ' + numberWithCommas(totalBill.toFixed(0)) +
                (isMember ? '<span style="color: red; font-size: 14px;"> (10% discount applied with a maximum discount of Rp. ' + numberWithCommas(maxDiscount.toFixed(0)) + ')</span>' : '');

            totalTagihanInput.value = totalBill.toFixed(0);
        });
    });

    function numberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
</script>