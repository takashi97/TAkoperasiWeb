<!-- Navbar -->
@include('layouts.navbar')
<!-- Navbar -->

<!doctype html>
<html lang="en">
<head>
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
  <link href="{{ asset('/css/cart.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <section class="container">
    <!-- Header -->
    <div class="judul text-left">
      <h1 style="color:white;" class="display-5 fw-bold">Cart</h1>
    </div>
    <!-- Header -->

    <!-- Content -->
      <main class="mt-3 pt-3">
      <div class="padding">
        <div class="container dark-grey-text">
          @if ($cart)
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Penjual</th>
                <th scope="col">Quantity</th>
                <th scope="col">Actions</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($cart->products as $product)
              <tr>
                <td>{{ $product->p_name }}</td>
                <td class="stock" data-product-id="{{ $product->id }}" data-stock="{{ $product->s_produk }}">{{ $product->s_produk }}</td>
                <td class="price">Rp. {{ number_format($product->h_produk, 0, '.', '.') }}</td>
                <td class="penjual">{{ ucwords($product->user->name) }}</td>
                <td>
                    <div class="quantity-container">
                    <form action="{{ route('cart.update', $product->id) }}" method="POST" class="update-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="quantity" data-product-id="{{ $product->id }}" class="quantity-display" value="{{ $product->pivot->quantity }}">
                        <button type="button" class="minus" data-cart-product-id="{{ $product->pivot->id }}">-</button>
                        <input type="text" class="quantity-input" data-product-id="{{ $product->id }}" value="{{ $product->pivot->quantity }}" min="1" max="100"
                        style="width: 15%">
                        <button type="button" class="plus" data-cart-product-id="{{ $product->pivot->id }}">+</button>
                        <button type="submit" class="hidden-btn" style="display: none;"></button>
                    </form>
                    </div>
                    
                </td>
                <td>
                    <form action="{{ route('cart.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color:white; background-color:rgb(199, 0, 57);" class="btn">Remove</button>
                    </form>
                </td>
                <td class="subtotal">Rp. {{ number_format($product->h_produk * $product->pivot->quantity, 0, '.', '.') }}</td>
            </tr>
            <tr>
              <td colspan="7">
                <div class="error-message" style="color: red; display: none;"></div>
              </td>
            </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr class="noborder">
                <td colspan="5"></td>
                <td><strong>Total :</strong></td>
                <td class="total">Rp. {{ number_format($cart->getTotalPrice(), 0, '.', '.') }}</td>
              </tr>
            </tfoot>
          </table>
          @else
          <p>No items in the cart.</p>
          @endif
        </div>
          <div class="btncheckout">
            <a style="color:white; background-color:rgb(88, 56, 250);"
            href="{{ url('checkoutpage') }}" class="btn buttontambah" role="button" aria-pressed="true"> 
            Checkout</a>
          </div>
      </div>
      </main>
    <!-- Content -->
  </section>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  // Set up CSRF token for AJAX requests
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function() {

    $('.minus, .plus').on('click', function() {
        var $form = $(this).closest('.update-form');
        var quantityInput = $form.find('.quantity-input');
        var quantityDisplay = $form.find('.quantity-display');
        var quantity = parseInt(quantityInput.val());
        var errorContainer = $(this).closest('tr').next().find('.error-message');
        var stock = parseInt($(this).closest('tr').find('.stock').data('stock'));

        if ($(this).hasClass('minus')) {
          quantity = Math.max(1, quantity - 1);
          hideError(errorContainer);
        } else if ($(this).hasClass('plus')) {
          if (stock > 0) {
            if (quantity < stock) {
              quantity++;
              hideError(errorContainer);
            } else {
              showError(errorContainer, 'Pembelian produk diatas melebihi stok yang tersedia');
            }
          } else {
            if (quantity < 100) {
              quantity++;
              hideError(errorContainer);
            } else {
              showError(errorContainer, 'Pembelian melebihi batas');
            }
          }
        }

        // Update the quantity input and display
        quantityInput.val(quantity);
        quantityDisplay.val(quantity);

        // Send AJAX request to update the quantity
        $.ajax({
          url: $form.attr('action'),
          type: $form.attr('method'),
          data: $form.serialize(),
          success: function(response) {
            // Handle success response
            console.log(response);
            updateSubtotal(quantityInput);
            updateTotal();
          },
          error: function(xhr) {
            // Handle error response
            console.log(xhr);
          }
        });
      });
    $('.update-form').on('submit', function(e) {
      e.preventDefault(); // Prevent the default form submission

      var $form = $(this);
      var formData = $form.serialize();

      // Send the AJAX request to update the quantity
      $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: formData,
        success: function(response) {
          // Handle success response
          console.log(response);
          updateSubtotal($form.find('.quantity-input'));
          updateTotal();
        },
        error: function(xhr) {
          // Handle error response
          console.log(xhr);
        }
      });

      return false; // Prevent the form from being submitted normally
    });

    $('.quantity-input').on('change', function() {
      var $form = $(this).closest('.update-form');
      var quantity = $(this).val();
      var updateUrl = $form.attr('action');

      $.ajax({
        url: updateUrl,
        type: 'PUT',
        data: {
          _token: '{{ csrf_token() }}',
          quantity: quantity
        },
        success: function(response) {
          // Update the quantity display
          $('.quantity-display[data-product-id="' + $form.data('product-id') + '"]').text(quantity);
          updateSubtotal($form.find('.quantity-input'));
          updateTotal();
        },
        error: function(xhr) {
          // Handle any errors that occur during the AJAX request
          console.log(xhr.responseText);
        }
      });

    });

    $(document).on('change', '.quantity-input', function() {
      updateSubtotal($(this));
      updateTotal();
    });

    function updateSubtotal(quantityInput) {
      var priceElement = quantityInput.closest('tr').find('.price');
      var quantity = parseInt(quantityInput.val());
      var price = parseInt(priceElement.text().replace(/[^0-9]/g, ''));
      var subtotal = quantity * price;
      var subtotalFormatted = formatCurrency(subtotal);

      quantityInput.closest('tr').find('.subtotal').text('Rp. ' + subtotalFormatted);
    }

    function updateTotal() {
      var total = 0;

      $('.subtotal').each(function() {
        var subtotal = parseInt($(this).text().replace(/[^0-9]/g, ''));
        total += subtotal;
      });

      var totalFormatted = formatCurrency(total);
      $('.total').text('Rp. ' + totalFormatted);
    }

    function formatCurrency(number) {
      return number.toLocaleString('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
      });
    }
    $('.quantity-input').on('keydown', function(e) {
    var key = e.which || e.keyCode;

    if (key === 8) {
      return;
    }

    if (!isNumericInput(key) && !isModifierKey(key)) {
      e.preventDefault();
    }
  });

  $('.quantity-input').on('wheel', function(e) {
    e.preventDefault();
  });

  $('.quantity-input').on('input', function() {
  var quantity = parseInt($(this).val());
  var errorContainer = $(this).closest('tr').next().find('.error-message');
  var stock = parseInt($(this).closest('tr').find('.stock').text());

    if (isNaN(quantity) || quantity <= 0) {
      $(this).val(1);
      showError(errorContainer, 'Pembelian tidak boleh 0.');
    } else if (stock >= 100 && quantity > 100) {
      $(this).val(100);
      showError(errorContainer, 'Pembelian tidak boleh lebih dari 100.');
    } else if (stock < 100 && quantity > stock) {
      $(this).val(stock);
      showError(errorContainer, 'Pembelian melebihi stok yang tersedia.');
    } else {
      hideError(errorContainer);
    }
  });

  function isNumericInput(key) {
    return (key >= 48 && key <= 57) || (key >= 96 && key <= 105);
  }
  function isModifierKey(key) {
    var modifiers = [16, 17, 18, 91, 93];
    var arrowKeys = [37, 38, 39, 40];
    return modifiers.includes(key) || arrowKeys.includes(key);
  }


  function showError(container, message) {
    container.text(message).show();
  }

  function hideError(container) {
    container.hide();
  }
  });
</script>
