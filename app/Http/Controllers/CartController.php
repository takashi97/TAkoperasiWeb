<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Saldo;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Rekber;
use App\Models\User;
use App\Models\KoperasiSaldocontrol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('products')->first();

        return view('marketplace.mpcartpage', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = auth()->id();
            $cart->save();
        }

        $product = Product::find($request->product_id);

        // Check if the product already exists in the cart
        if ($cart->products()->where('product_id', $product->id)->exists()) {
            // Increment the quantity of the existing product
            $cart->products()->updateExistingPivot($product->id, [
                'quantity' => DB::raw('quantity + 1')
            ]);
        } else {
            // Check if the product quantity is greater than zero
            if ($product->s_produk > 0) {
                // Add the product to the cart with a quantity of 1
                $cart->products()->attach($product->id, ['quantity' => 1]);
            } else {
                return redirect()->back()->withErrors(['error' => 'Product is out of stock.']);
            }
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $product = Product::find($id);
    
        if (!$cart || !$product) {
            return response()->json(['error' => 'Cart or product not found.'], 404);
        }
    
        $quantity = $request->input('quantity');
    
        // Update the quantity of the product in the cart
        $cart->products()->updateExistingPivot($product->id, ['quantity' => $quantity]);
    
        // Return a JSON response with the updated quantity
        return response()->json(['success' => 'Product quantity updated.', 'quantity' => $quantity]);
    }
        
    public function destroy($id)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        $product = Product::find($id);

        $cart->products()->detach($product->id);

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    public function showMpcheckoutPage()
    {
        $buyer = Auth::user(); // Assuming the authenticated user is the buyer

        // Retrieve the seller user based on the product's user_id
        $product = Product::first(); // Retrieve any product, you can adjust this condition based on your requirement

        if (!$product) {
            // Handle the case where no product is found
            // You can redirect or show an error message
        }

        $sellerId = $product->user_id;
        $seller = User::findOrFail($sellerId);

        // Retrieve the current user's ID and check if they are a member
        $userId = auth()->id();
        $user = User::find($userId);
        $isMember = $user->level === "member";

        // Pass the buyer, seller, and isMember variables to the view
        $cart = Cart::where('user_id', $userId)->with('products')->first();
        $shippings = Shipping::all();
        return view('marketplace.checkoutpage', compact('buyer', 'seller', 'cart', 'shippings', 'isMember'));
    }

    
    
    public function processMpCheckoutPage(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'cart_id' => 'required|numeric',
            'alamat_kirim' => 'required|string',
            't_tagihan' => 'required|numeric',
            'shipping_id' => 'nullable|numeric',
        ]);

        // Retrieve the current user's ID
        $userId = $request->user()->id;
        $user = User::find($userId);
        $isMember = $user->level === "member";
        $isUmkm = $user->level === "umkm";
        // Retrieve the cart
        $cart = Cart::with('products.user')->find($request->input('cart_id'));

        if (!$cart) {
            throw new \Exception('Cart not found.');
        }

        $product = $cart->products()->first();
        $sellerId = $product->user->id;

        // Retrieve the shipping cost
        $shipping = Shipping::findOrFail($request->input('shipping_id'));
        $shippingCost = $shipping->shipping_cost;
        $totalTagihan = $cart->getTotalPrice();
        $adminfee = $totalTagihan * 0.015;
        $adminfeeumkm = $totalTagihan * 0.01;
        $selleradmin = $isUmkm ? $adminfee : $adminfeeumkm;
        if ($isMember) {
            $discount = $totalTagihan * 0.1; // Apply a 10% discount for members

            // Check if the discount exceeds the maximum discount amount
            $maxDiscount = 20000; // Maximum discount amount of Rp. 20,000
            $discount = min($discount, $maxDiscount);

            $totalTagihan -= $discount;

            $rekber = Rekber::first();
            $rekber->rekber_saldo -= $discount;
            $rekber->rekber_saldo += $selleradmin;
            $rekber->save();
            

        }
        else
        {

            $rekber = Rekber::first();
            $rekber->rekber_saldo += $selleradmin;
            $rekber->save();
        }
        // Calculate the total order amount
        $totalAmount = $totalTagihan + $shippingCost;

        // Check product stock before deducting saldo
        foreach ($cart->products as $product) {
            $quantity = $product->pivot->quantity;
            if ($product->s_produk < $quantity) {
                return redirect()->back()->withErrors(['error' => 'Insufficient stock']);
            }

            // Deduct product stock
            $product->s_produk -= $quantity;
            $product->save();
        }

        // Check if the user has sufficient saldo
        $saldo = Saldo::where('user_id', $userId)->first();
        $saldoAmount = $saldo->saldo;

        if ($totalAmount <= $saldoAmount) {
            // The saldo covers the total amount
            $saldo->saldo -= $totalAmount;
            $saldo->save();

            // Add saldo control record for the buyer
            $saldoControlBuyer = new KoperasiSaldocontrol();
            $saldoControlBuyer->user_id = $userId;
            $saldoControlBuyer->saldo_control = $totalAmount;

            $saldoControlBuyer->keterangan = 'Saldo_Kurang';
            $saldoControlBuyer->save();

            // Find or create the seller's saldo account
            $sellerSaldo = Saldo::where('user_id', $sellerId)->first();

            

            // Check if $sellerSaldo exists and update it or create a new record
            if ($sellerSaldo) {
                $sellerSaldo->saldo += $totalAmount;
                $sellerSaldo->saldo -= $selleradmin;
                $sellerSaldo->save();
            } else {
                $sellerSaldo = new Saldo();
                $sellerSaldo->user_id = $sellerId;
                $sellerSaldo->saldo = $totalAmount;
                $sellerSaldo->saldo -= $selleradmin;
                $sellerSaldo->save();
            }
            /*
            dummy
            if ($sellerSaldo) {
                // If the seller's saldo account exists, update the saldo using the original total amount
                $sellerSaldo->saldo += $totalAmount;
                if($isUmkm)
                {
                    $sellerSaldo->saldo -= $adminfeeumkm; 
                }
                else 
                {
                    $sellerSaldo->saldo -= $adminfee; 
                }
                $sellerSaldo->save();
            } else {
                // If the seller's saldo account does not exist, create a new record with the original total amount
                $sellerSaldo = new Saldo();
                $sellerSaldo->user_id = $sellerId;
                $sellerSaldo->saldo = $totalAmount;
                if($isUmkm)
                {
                    $sellerSaldo->saldo -= $adminfeeumkm; 
                }
                else 
                {
                    $sellerSaldo->saldo -= $adminfee; 
                }
                $sellerSaldo->save();
            }*/

            // Add saldo control record for the seller
            $saldoControlSeller = new KoperasiSaldocontrol();
            $saldoControlSeller->user_id = $sellerId;
            $saldoControlSeller->saldo_control = $totalAmount;
            $saldoControlSeller->saldo_control -= $selleradmin; 
            $saldoControlSeller->keterangan = 'Saldo_Tambah';
            $saldoControlSeller->save();

            // Store the checkout information in the database
            $order = Order::create($validatedData);

            // Detach products from the cart
            $cart->products()->detach();

            // Associate the purchased products with the order
            $order->products()->attach($request->input('cart_id'));

            // Redirect or return a response
            $products = Product::all();
            return view('marketplace.marketplacehome', compact('products'));
        } else {
            // The saldo is not enough to cover the total amount
            return redirect()->back()->withErrors(['error' => 'Insufficient saldo.']);
        }
    }
    public function showMpTransaction(Request $request)
    {
        $userId = $request->user()->id; // Assuming you want to retrieve orders for the currently authenticated user

        $orders = Order::with('user', 'cart.products')
                    ->where('user_id', $userId)
                    ->get();

        return view('marketplace.mpdashboard', ['orders' => $orders]);
    }
    /*public function processMpCheckoutPage(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'cart_id' => 'required|numeric',
            'alamat_kirim' => 'required|string',
            't_tagihan' => 'required|numeric',
            'shipping_id' => 'nullable|numeric',
        ]);

        // Retrieve the current user's ID
        $userId = $request->user()->id;

        // Retrieve the cart
        $cart = Cart::with('products')->find($request->input('cart_id'));

        if (!$cart) {
            throw new \Exception('Cart not found.');
        }

        // Retrieve the shipping cost
        $shipping = Shipping::findOrFail($request->input('shipping_id'));
        $shippingCost = $shipping->shipping_cost;

        // Calculate the total order amount
        $totalAmount = $cart->getTotalPrice() + $shippingCost;

        // Check if the user has sufficient saldo
        $saldo = Saldo::where('user_id', $userId)->first();
        $saldoAmount = $saldo->saldo;

        if ($totalAmount <= $saldoAmount) {
            // The saldo covers the total amount
            $saldo->saldo -= $totalAmount;
            $saldo->save();

            // Add saldo control record
            $saldoControl = new KoperasiSaldocontrol();
            $saldoControl->user_id = $userId;
            $saldoControl->saldo_control = $totalAmount;
            $saldoControl->keterangan = 'Saldo_Kurang';
            $saldoControl->save();

            // Store the checkout information in the database
            $order = Order::create($validatedData);

            // Detach products from the cart
            $cart->products()->detach();

            // Associate the purchased products with the order
            $order->products()->attach($request->input('cart_id'));

            // Redirect or return a response
            $products = Product::all();
            return view('marketplace.marketplacehome', compact('products'));
        } else {
            // The saldo is not enough to cover the total amount
            return redirect()->back()->withErrors(['error' => 'Insufficient saldo.']);
        }
    }*/
}
