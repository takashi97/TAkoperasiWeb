<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\PinjamanApproval;
use Illuminate\Support\Facades\Validator;

class PinjamController extends Controller
{
    public function showPinjamForm(Request $request)
    {
        return view('koperasi.form.koperasipinjamform');
    }
    public function processPinjamForm(Request $request)
    {
        $jum_simpanan= Simpanan::where('user_id', auth()->id())->value('jum_simpanan');

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'jum_pinjaman' => ['required', 'numeric', 'min:10000', 'max:1000000', function ($attribute, $value, $fail) use ($jum_simpanan) {
                if ($jum_simpanan < $value) {
                    $fail('Saldo anda tidak mencukupi untuk melakukan penarikan.');
                }
            }],
            'dur_pinjaman' => ['required', 'numeric', 'min:1', 'max:30'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'dur_pinjaman.required' => 'Durasi pinjaman harus diisi.',
            'dur_pinjaman.numeric' => 'Durasi pinjaman harus berupa angka.',
            'dur_pinjaman.min' => 'Durasi waktu pinjaman minimal :min.',
            'dur_pinjaman.max' => 'Durasi waktu pinjaman maksimal :max.',

            'jum_pinjaman.required' => 'Jumlah pinjaman harus diisi.',
            'jum_pinjaman.numeric' => 'Jumlah pinjaman harus berupa angka.',
            'jum_pinjaman.min' => 'Jumlah pinjaman minimal :min.',
            'jum_pinjaman.max' => 'Jumlah pinjaman maksimal :max.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $pinjaman = new Pinjaman;
        $pinjaman->user_id = auth()->id();
        $pinjaman->name = auth()->user()->name;
        $pinjaman->dur_pinjaman = $request->dur_pinjaman;
        $pinjaman->jum_pinjaman = $request->jum_pinjaman;
        $pinjaman->t_pinjaman = now(); // set the current date as the default value
        $pinjaman->save();

        $pinjamanApproval = new PinjamanApproval;
        $pinjamanApproval->pinjaman_id = $pinjaman->id;
        $pinjamanApproval->status = 'pending';
        $pinjamanApproval->note = null;
        $pinjamanApproval->save();

        return redirect()->route('pinjam')->with('success', 'Data pinjaman berhasil disimpan dan menunggu persetujuan admin.');
    }
}
