<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function showMpkatmakananPage()
    {
        $products = Product::where('j_produk', 'makanan')->get();
        return view('marketplace.mpkatmakanan', compact('products'));
    }

    public function showMpkatpakaianPage()
    {
        $products = Product::where('j_produk', 'pakaian')->get();
        return view('marketplace.mpkatpakaian', compact('products'));
    }

    public function showMpkataksesorisPage()
    {
        $products = Product::where('j_produk', 'aksesoris')->get();
        return view('marketplace.mpkataksesoris', compact('products'));
    }

    public function showMprekomendasiPage()
    {
            $products = Product::all();
    return view('marketplace.marketplacehome', compact('products'));
    }

    public function showProductPage($identifier)
    {
        $product = Product::where('identifier', $identifier)->firstOrFail();
        return view('marketplace.produkpage', compact('product'));
    }

    public function showMpsellPage()
    {
        $user = Auth::user();
        if ($user->level == 'admin') 
        {
            $products = Product::all();
            return view('marketplace.mpsellpage', compact('products'));
        }
        elseif ($user->level == 'member' || $user->level == 'umkm')
        {
            $products = Product::where('user_id', $user->id)
            ->get();
            return view('marketplace.mpsellpage', compact('products'));
        }
        
    }


    public function showMpsellForm()
    {
        return view('marketplace.form.mpsellform');
    }

    public function processMpsellForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'p_name' => ['required', 'string', 'max:255'],
            'image_produk' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'j_produk' => ['required', 'in:makanan,pakaian,aksesoris'],
            'h_produk' => ['required', 'numeric', 'min:1000', 'max:5000000'],
            'k_produk' => ['required', 'in:baru,bekas'],
            's_produk' => ['required', 'numeric', 'min:1', 'max:999'],
            'b_produk' => ['required', 'numeric', 'min:0.01', 'max:999.99'],
            'd_produk' => ['required', 'string', 'max:2000'],
        ],
            
        [
            'p_name.required' => 'Nama produk harus ada.',
            'p_name.max' => 'Nama produk terlalu panjang.',
            'image_produk.required' => 'Gambar Produk tidak boleh kosong',
            'image_produk.mimes' => 'Gambar Produk dimasukan dalam format jpeg, jpg, atau png.',
            'image_produk.max' => 'Gambar Produk tidak boleh lebih dari 2048px.',
            'j_produk.required' => 'Kategori produk harus dipilih.',
            'j_produk.in' => 'Kategori produk tidak valid.',
            'h_produk.required' => 'Harga produk harus diisi.',
            'h_produk.numeric' => 'Harga produk harus berupa angka.',
            'h_produk.min' => 'Harga produk minimal :min.',
            'h_produk.max' => 'Harga produk maksimal :max.',
            'k_produk.required' => 'Kondisi produk harus dipilih.',
            'k_produk.in' => 'Kondisi produk tidak valid.',
            's_produk.required' => 'Stok produk harus diisi.',
            's_produk.numeric' => 'Stok produk harus berupa angka.',
            's_produk.min' => 'Stok produk minimal :min.',
            's_produk.max' => 'Stok produk maksimal :max.',
            'b_produk.required' => 'Berat produk harus diisi.',
            'b_produk.numeric' => 'Berat produk harus berupa angka dapat desimal (satuan kg).',
            'b_produk.min' => 'Berat produk minimal :min.',
            'b_produk.max' => 'Berat produk maksimal :max.',
            'd_produk.required' => 'Deskripsi produk harus diisi.',
            'd_produk.string' => 'Deskripsi produk berupa text',
            'd_produk.max' => 'Deskripsi produk maksimal :max kata.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $product = new Product;
        $product->user_id = auth()->id();
        $product->p_name = $request->p_name;
        if ($request->hasFile('image_produk')) {
            $image = $request->file('image_produk');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image_produk/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $product->image_produk = $filename;
        }
        $product->j_produk = $request->j_produk;
        $product->h_produk = $request->h_produk;
        $product->k_produk = $request->k_produk;
        $product->s_produk = $request->s_produk;
        $product->b_produk = $request->b_produk;
        $product->d_produk = $request->d_produk;
        $product->identifier = Str::uuid()->toString(); 
        $product->save();

        return redirect()->route('mpsell')->with('success', 'Data produk berhasil disimpan.');
    }
    public function showupdateMpsellForm($identifier)
    {
        $product = Product::where('identifier', $identifier)->firstOrFail();
        return view('marketplace.mpprodukedit', compact('product'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('query'));

        if (empty($query)) {
            // Handle empty search query
            // Redirect back or display an error message
            $products = Product::all();
            return view('marketplace.marketplacehome', compact('products'));
        }

        // Perform your search logic here based on the $query

        // For example, assuming you have a 'Product' model and you want to search by product name:
        $searchResults = Product::where('p_name', 'like', '%' . $query . '%')->get();

        // Return the search results to the view
        return view('marketplace.search', compact('searchResults', 'query'));
    }
    
    public function updateMpsellForm(Request $request, $identifier)
    {
        $product = Product::where('identifier', $identifier)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'p_name' => ['required', 'string', 'max:255'],
            'image_produk' => ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'j_produk' => ['required', 'in:makanan,pakaian,aksesoris'],
            'h_produk' => ['required', 'numeric', 'min:1000', 'max:5000000'],
            'k_produk' => ['required', 'in:baru,bekas'],
            's_produk' => ['required', 'numeric', 'min:1', 'max:999'],
            'b_produk' => ['required', 'numeric', 'min:0.01', 'max:999.99'],
            'd_produk' => ['required', 'string', 'max:2000'],
        ],
            
        [
            'p_name.required' => 'Nama produk harus ada.',
            'p_name.max' => 'Nama produk terlalu panjang.',
            'image_produk.mimes' => 'Gambar Produk dimasukan dalam format jpeg, jpg, atau png.',
            'image_produk.max' => 'Gambar Produk tidak boleh lebih dari 2048px.',
            'j_produk.required' => 'Kategori produk harus dipilih.',
            'j_produk.in' => 'Kategori produk tidak valid.',
            'h_produk.required' => 'Harga produk harus diisi.',
            'h_produk.numeric' => 'Harga produk harus berupa angka.',
            'h_produk.min' => 'Harga produk minimal :min.',
            'h_produk.max' => 'Harga produk maksimal :max.',
            'k_produk.required' => 'Kondisi produk harus dipilih.',
            'k_produk.in' => 'Kondisi produk tidak valid.',
            's_produk.required' => 'Stok produk harus diisi.',
            's_produk.numeric' => 'Stok produk harus berupa angka.',
            's_produk.min' => 'Stok produk minimal :min.',
            's_produk.max' => 'Stok produk maksimal :max.',
            'b_produk.required' => 'Berat produk harus diisi.',
            'b_produk.numeric' => 'Berat produk harus berupa angka dapat desimal (satuan kg).',
            'b_produk.min' => 'Berat produk minimal :min.',
            'b_produk.max' => 'Berat produk maksimal :max.',
            'd_produk.required' => 'Deskripsi produk harus diisi.',
            'd_produk.string' => 'Deskripsi produk berupa text',
            'd_produk.max' => 'Deskripsi produk maksimal :max kata.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $product->p_name = $request->p_name;
        if ($request->hasFile('image_produk')) {
            $image = $request->file('image_produk');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image_produk/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $product->image_produk = $filename;
        }
        $product->j_produk = $request->j_produk;
        $product->h_produk = $request->h_produk;
        $product->k_produk = $request->k_produk;
        $product->s_produk = $request->s_produk;
        $product->b_produk = $request->b_produk;
        $product->d_produk = $request->d_produk;
        $product->save();
        return redirect()->route('mpprodukedit', ['identifier' => $product->identifier])->with('success', 'Data produk berhasil disimpan.');

    }
    public function showdeleteMpsellForm($identifier)
    {
        $product = Product::where('identifier', $identifier)->firstOrFail();
        return view('marketplace.mpprodukdelete', compact('product'));
    }

    public function deleteMpsellForm($identifier)
    {
        $product = Product::where('identifier', $identifier)->firstOrFail();
        if (Auth::id() == $product->user_id) {
            Storage::delete('public/image_produk/' . $product->image_produk);
            $product->delete();
            return redirect()->route('mpsellpage', ['identifier' => $product->identifier])->with('success', 'Data produk berhasil dihapus.');
        }
        return redirect()->route('mpprodukdelete', ['identifier' => $product->identifier])->with('error', 'Anda tidak memiliki hak untuk menghapus data produk ini.');
    }

    
    

}

