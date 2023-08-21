<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class UpdateumkmController extends Controller
{
    public function updateUmkm(Request $request)
    {
        $user = Auth::user(); // get the authenticated user 
        $data = $request->all();

        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'nik.required' => 'Nomor Induk Keluarga tidak boleh kosong.',
            'nik.digits' => 'Nomor Induk Keluarga harus terdiri dari :digits karakter.',
            'nik.unique' => 'Nomor Induk Keluarga harus diisi sesuai dengan KTP anda.',
            'image_ktp.required' => 'Gambar KTP tidak boleh kosong.',
            'image_ktp.mimes' => 'Gambar KTP dimasukan dalam format jpeg, jpg, atau png.',
            'image_ktp.max' => 'Gambar KTP tidak boleh lebih dari 2048px.',
            'npwp.required' => 'NPWP harus diisi',
            'npwp.regex' => 'Isilah NPWP dengan benar',
            'alamat_ktp.required' => 'Alamat KTP tidak boleh kosong.',
            // add more custom messages here
        ];

        // validate the input
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'alamat_ktp' => ['required', 'string'],
            'image_ktp' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'nik' => ['required', 'digits:16', 'unique:users'],
            'npwp' => ['required', 'regex:/^[0-9]{15}$/'],
        ],$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // update the user's data
        $user->level = 'umkm'; // update the user's role
        $user->name = $data['name'];
        $user->alamat_ktp = $data['alamat_ktp'];
        $user->nik = $data['nik'];
        $user->npwp = $data['npwp'];

        // process and store the uploaded image file
        if ($request->hasFile('image_ktp')) {
            $image = $request->file('image_ktp');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image_ktp/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $user->image_ktp = $filename;
        }

        $user->save(); // save the updated user information

        return redirect('/'); // redirect to the dashboard or other appropriate page
    }
}
