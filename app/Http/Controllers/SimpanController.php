<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Saldo;
use App\Models\SimpananApproval;
use Illuminate\Support\Facades\Validator;

class SimpanController extends Controller
{
    public function showSimpanForm(Request $request)
    {
        return view('koperasi.form.koperasisimpanform');
    }

    public function processSimpanForm(Request $request)
    {
        $saldo = Saldo::where('user_id', auth()->id())->value('saldo');

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'j_simpanan' => ['required', 'in:wajib,pokok,sukarela'],
            'jum_simpanan' => ['required', 'numeric', 'min:10000', 'max:5000000', function ($attribute, $value, $fail) use ($saldo) {
                if ($saldo < $value) {
                    $fail('Saldo anda tidak mencukupi untuk melakukan simpanan.');
                }
            }],
        ], [
            'name.required' => 'Nama harus diisi.',
            'j_simpanan.required' => 'Jenis simpanan harus dipilih.',
            'j_simpanan.in' => 'Jenis simpanan tidak valid.',
            'jum_simpanan.required' => 'Jumlah simpanan harus diisi.',
            'jum_simpanan.numeric' => 'Jumlah simpanan harus berupa angka.',
            'jum_simpanan.min' => 'Jumlah simpanan minimal :min.',
            'jum_simpanan.max' => 'Jumlah simpanan maksimal :max.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $simpanan = new Simpanan;
        $simpanan->user_id = auth()->id();
        $simpanan->name = auth()->user()->name;
        $simpanan->j_simpanan = $request->j_simpanan;
        $simpanan->jum_simpanan = $request->jum_simpanan;
        $simpanan->t_simpanan = now();
        $simpanan->save();

        $simpananApproval = new SimpananApproval;
        $simpananApproval->simpanan_id = $simpanan->id;
        $simpananApproval->status = 'pending';
        $simpananApproval->note = null;
        $simpananApproval->save();

        return redirect()->route('simpan')->with('success', 'Data simpanan berhasil disimpan dan menunggu persetujuan admin.');
    }
}