<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penarikan;
use App\Models\Simpanan;
use App\Models\PenarikanApproval;
use Illuminate\Support\Facades\Validator;

class PenarikanController extends Controller
{
    public function showPenarikanForm(Request $request)
    {
        return view('koperasi.form.koperasipenarikanform');
    }
    public function processPenarikanForm(Request $request)
    {
        $jum_simpanan= Simpanan::where('user_id', auth()->id())->value('jum_simpanan');
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'jum_penarikan' => ['required', 'numeric', 'min:10000', 'max:1000000', function ($attribute, $value, $fail) use ($jum_simpanan) {
                if ($jum_simpanan < $value) {
                    $fail('Saldo anda tidak mencukupi untuk melakukan penarikan.');
                }
            }],
        ], [
            'name.required' => 'Nama harus diisi.',
            'jum_penarikan.required' => 'Jumlah penarikan harus diisi.',
            'jum_penarikan.numeric' => 'Jumlah penarikan harus berupa angka.',
            'jum_penarikan.min' => 'Jumlah penarikan minimal :min.',
            'jum_penarikan.max' => 'Jumlah penarikan maksimal :max.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $penarikan = new Penarikan;
        $penarikan->user_id = auth()->id();
        $penarikan->name = auth()->user()->name;
        $penarikan->jum_penarikan = $request->jum_penarikan;
        $penarikan->t_penarikan = now(); // set the current date as the default value
        $penarikan->save();

        $penarikanApproval = new PenarikanApproval;
        $penarikanApproval->penarikan_id = $penarikan->id;
        $penarikanApproval->status = 'pending';
        $penarikanApproval->note = null;
        $penarikanApproval->save();

        return redirect()->route('penarikan')->with('success', 'Data penarikan berhasil disimpan.');
    }
}
