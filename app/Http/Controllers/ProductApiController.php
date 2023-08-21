<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function addproduk(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'p_name' => 'required|string',
                'k_produk' => 'required|string',
                'h_produk' => 'required|integer|min:1',
                's_produk' => 'required|integer',
                'j_produk' => 'required|string',
                'b_produk' => 'required|numeric|min:0',
                'd_produk' => 'required|string',
                
            ]);

            $product = new Product();
            $product->user_id = $validatedData['user_id'];
            $product->p_name = $validatedData['p_name'];
            $product->k_produk = $validatedData['k_produk'];
            $product->h_produk = $validatedData['h_produk'];
            $product->s_produk = $validatedData['s_produk'];
            $product->j_produk = $validatedData['j_produk'];
            $product->b_produk = $validatedData['b_produk'];
            $product->d_produk = $validatedData['d_produk'];
            $product->identifier = Str::uuid()->toString(); 

            if ($request->hasFile('image_produk')) {
                $image = $request->image_produk;
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('image_produk/'), $imageName);
                $product->image_produk = $imageName;
            }

            /*$base64_str = substr($request->image_produk, strpos($request->image_produk, ",")+1);
            $image = base64_decode($base64_str);
            $png_url = "product-".time().".png";
            $path = public_path('image_produk/' . $png_url);
            Image::make(file_get_contents($request->image_produk))->save($path); */

            $product->save();

            return response()->json(['success' => 'Product added successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addimage(Request $request)
{
    try {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            return response()->json(['success' => 'Image uploaded successfully.', 'image_path' => '/images/' . $imageName], 200);
        }

        return response()->json(['error' => 'Image file not found.'], 400);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function test(Request $request)
    {
        return response()->json(['message' => $request->a]);
    }
    public function processMpsellForm(Request $request)
    {
        /*$validator = Validator::make($request->all(), [
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
        */

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
}
