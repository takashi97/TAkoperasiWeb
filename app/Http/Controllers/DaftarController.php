<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class DaftarController extends Controller
{
    public function showDaftarForm(Request $request)
    {
        $user = Auth::user();
        if ($request->is('daftarmember')) {
            return view('daftarmember');
        } elseif ($request->is('daftarumkm')) {
            return view('daftarumkm');
        } else {
            abort(404);
        }
    }
    public function processDaftarForm(Request $request)
    {
        $user = Auth::user();
        $data = $request->only('formType', 'name', 'alamat_ktp', 'image_ktp', 'nik', 'npwp');
        $formType = request()->input('formType');

        $rules = [
            'formType' => ['required','in:form0,form1,form2'],
            'name' => ['required', 'string', 'max:255'],
            'alamat_ktp' => ['required', 'string'],
            'image_ktp' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'nik' => ['required', 'digits:16', 'unique:users'],
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'nik.required' => 'Nomor Induk Keluarga tidak boleh kosong.',
            'nik.digits' => 'Nomor Induk Keluarga harus terdiri dari :digits karakter.',
            'nik.unique' => 'Nomor Induk Keluarga harus diisi sesuai dengan KTP anda.',
            'image_ktp.required' => 'Gambar KTP tidak boleh kosong.',
            'image_ktp.mimes' => 'Gambar KTP dimasukan dalam format jpeg, jpg, atau png.',
            'image_ktp.max' => 'Gambar KTP tidak boleh lebih dari 2048px.',
            'alamat_ktp.required' => 'Alamat KTP tidak boleh kosong.',
        ];

        if ($formType === 'form1') {
            $rules['npwp'] = ['required', 'regex:/^[0-9]{15}$/'];
            $messages['npwp.required'] = 'NPWP harus diisi';
            $messages['npwp.regex'] = 'Isilah NPWP dengan benar';
        }

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all())
                ->with('formType', $formType);
        }

        $user->level = 'member';
        $user->name = $data['name'];
        $user->alamat_ktp = $data['alamat_ktp'];
        $user->nik = $data['nik'];

        if ($request->hasFile('image_ktp')) {
            $image = $request->file('image_ktp');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image_ktp/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $user->image_ktp = $filename;
        }

        if ($formType === 'form1') {
            $user->npwp = $data['npwp'];
            $user->level = 'umkm';
            $user->save();
            return redirect()->route('daftarumkm')->with('success', 'Data updated successfully.');
        } else if ($formType === 'form2') {
            $user->save();
            return redirect()->route('daftarmember')->with('success', 'Data updated successfully.');
        }
    }
}