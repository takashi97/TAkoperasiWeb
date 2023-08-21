<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topup;
use App\Models\TopupApproval;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class TopupController extends Controller
{
    public function showTopupForm(Request $request)
    {
        return view('koperasi.form.formtopup');
    }
    public function processTopupForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'jum_topup' => ['required', 'numeric', 'min:10000', 'max:1000000'],
            'image_topup' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'jum_topup.required' => 'Jumlah topup harus diisi.',
            'jum_topup.numeric' => 'Jumlah topup harus berupa angka.',
            'jum_topup.min' => 'Jumlah topup minimal :min.',
            'jum_topup.max' => 'Jumlah topup maksimal :max.',
            'image_topup.required' => 'Gambar Top Up tidak boleh kosong.',
            'image_topup.mimes' => 'Gambar Top Updimasukan dalam format jpeg, jpg, atau png.',
            'image_topup.max' => 'Gambar Top Up tidak boleh lebih dari 2048px.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $topup = new Topup;
        $topup->user_id = auth()->id();
        $topup->name = auth()->user()->name;
        $topup->jum_topup = $request->jum_topup;
        $topup->t_topup = now(); // set the current date as the default value
        if ($request->hasFile('image_topup')) {
            $image = $request->file('image_topup');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('image_topup/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $topup->image_topup = $filename;
        }
        $topup->save();

        $topupApproval = new topupApproval;
        $topupApproval->topup_id = $topup->id;
        $topupApproval->status = 'pending';
        $topupApproval->note = null;
        $topupApproval->save();

        return redirect()->route('topup')->with('success', 'Data topup berhasil disimpan.');
    }
}
