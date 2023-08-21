<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Saldo;
use App\Models\Penarikan;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\PinjamanApproval;
use App\Models\PenarikanApproval;
use App\Models\SimpananApproval;

use Illuminate\Support\Facades\Validator;


class KoperasiApiController extends Controller
{

    public function penarikanform(Request $request)
    {
        try{

        
                $jum_simpanan= Simpanan::where('user_id', auth()->id())->value('jum_simpanan');
                $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'jum_penarikan' => ['required', 'numeric', 'min:10000', 'max:1000000'],
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
                $penarikan->user_id = $request->user_id;
                $penarikan->name = $request->name;
                $penarikan->jum_penarikan = $request->jum_penarikan;
                $penarikan->t_penarikan = now(); // set the current date as the default value
                $penarikan->save();

                $penarikanApproval = new PenarikanApproval;
                $penarikanApproval->penarikan_id = $penarikan->id;
                $penarikanApproval->status = 'pending';
                $penarikanApproval->note = null;
                $penarikanApproval->save();

                return response()->json(['success' => 'Product added successfully.'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        
    }
    public function pinjamanform(Request $request)
    {
        try {
            $jum_simpanan = Simpanan::where('user_id', auth()->id())->value('jum_simpanan');

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'jum_pinjaman' => ['required', 'numeric', 'min:10000', 'max:1000000'],
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
                return response()->json(['error' => $validator->errors()], 400);
            }

            $pinjaman = new Pinjaman;
            $pinjaman->user_id = $request->user_id;
            $pinjaman->name = $request->name;
            $pinjaman->dur_pinjaman = $request->dur_pinjaman;
            $pinjaman->jum_pinjaman = $request->jum_pinjaman;
            $pinjaman->t_pinjaman = now(); // set the current date as the default value
            $pinjaman->save();

            $pinjamanApproval = new PinjamanApproval;
            $pinjamanApproval->pinjaman_id = $pinjaman->id;
            $pinjamanApproval->status = 'pending';
            $pinjamanApproval->note = null;
            $pinjamanApproval->save();

            return response()->json(['success' => 'Data pinjaman berhasil disimpan dan menunggu persetujuan admin.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function simpananform(Request $request)
    {
        try {
            $saldo = Saldo::where('user_id', auth()->id())->value('saldo');

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'j_simpanan' => ['required', 'in:wajib,pokok,sukarela'],
                'jum_simpanan' => ['required', 'numeric', 'min:10000', 'max:5000000'],
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
                return response()->json(['error' => $validator->errors()], 400);
            }

            $simpanan = new Simpanan;
            $simpanan->user_id = $request->user_id;
            $simpanan->name = $request->name;
            $simpanan->j_simpanan = $request->j_simpanan;
            $simpanan->jum_simpanan = $request->jum_simpanan;
            $simpanan->t_simpanan = now();
            $simpanan->save();

            $simpananApproval = new SimpananApproval;
            $simpananApproval->simpanan_id = $simpanan->id;
            $simpananApproval->status = 'pending';
            $simpananApproval->note = null;
            $simpananApproval->save();

            return response()->json(['success' => 'Data simpanan berhasil disimpan dan menunggu persetujuan admin.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getjumsimpanan($userId)
    {
        $jumSimpanan = Simpanan::where('user_id', $userId)->sum('jum_simpanan');
        
        return response()->json($jumSimpanan);
    }
    public function showsimpanan($userId)
    {
        $Simpanan = Simpanan::where('user_id', $userId)->get();
        return response()->json($Simpanan);
    }
    public function showpinjaman($userId)
    {
        $Pinjaman = Pinjaman::where('user_id', $userId)->get();
        return response()->json($Pinjaman);
    }
    public function showpenarikan($userId)
    {
        $Penarikan = Penarikan::where('user_id', $userId)->get();
        return response()->json($Penarikan);
    }
}
