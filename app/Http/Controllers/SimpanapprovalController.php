<?php

namespace App\Http\Controllers;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\KoperasiSaldocontrol;
use App\Models\Penarikan;
use App\Models\Rekber;
use App\Models\Topup;
use App\Models\Saldo;
use App\Models\SimpananSaldo;
use App\Models\SimpananApproval;
use Illuminate\Http\Request;

class SimpanapprovalController extends Controller
{
    public function index(Request $request)
    {
        $simpanans = [];
        $pinjamans = [];
        $penarikans = [];
        $topups = [];

        if (Simpanan::count() > 0) {
            $simpanans = Simpanan::where('approved', false)->get();
        }
        if (Pinjaman::count() > 0) {
            $pinjamans = Pinjaman::where('approved', false)->get();
        }
        if (Penarikan::count() > 0) {
            $penarikans = Penarikan::where('approved', false)->get();
        }
        if (Topup::count() > 0) {
            $topups = Topup::where('approved', false)->get();
        }

        return view('koperasi.koperasihome', compact(['simpanans','penarikans','pinjamans','topups']));
    }
    public function approve(Request $request, $id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $simpanan->approved = true;
        $simpanan->save();

        $simpananApproval = SimpananApproval::where('simpanan_id', $simpanan->id)->first();
        $simpananApproval->status = 'approved';
        $simpananApproval->note = $request->note;
        $simpananApproval->save();

        $saldocontrol = new KoperasiSaldocontrol();
        
        if ($simpanan->j_simpanan === 'pokok') {
            $saldocontrol->user_id = $simpanan->user_id;
            $saldocontrol->saldo_control = $simpanan->jum_simpanan;
            $saldocontrol->saldo_control += 50000;
            $saldocontrol->keterangan = 'Saldo_Kurang';

            $rekber = Rekber::first();
            $rekber->rekber_saldo += 50000;
            $rekber->save();
        }
        else if($simpanan->j_simpanan === 'wajib')
        {
            $saldocontrol->user_id = $simpanan->user_id;
            $saldocontrol->saldo_control = $simpanan->jum_simpanan;
            $saldocontrol->saldo_control += 100;
            $saldocontrol->keterangan = 'Saldo_Kurang';

            $rekber = Rekber::first();
            $rekber->rekber_saldo += 100;
            $rekber->save();
        }
        else
        {
            $saldocontrol->user_id = $simpanan->user_id;
            $saldocontrol->saldo_control = $simpanan->jum_simpanan;
            $saldocontrol->keterangan = 'Saldo_Kurang';
        }

        $saldocontrol->save();
        
        $saldocontrolTambah = KoperasiSaldocontrol::where('user_id', $simpanan->user_id)->where('keterangan', 'Saldo_Tambah')->sum('saldo_control');
        $simpanan_saldo = $simpanan->sum('jum_simpanan');

        if ($saldocontrolTambah) {
            $simpanan_saldo -= $saldocontrolTambah;
        }

        $simpananRecord = SimpananSaldo::where('user_id', $simpanan->user_id)->first();

        if ($simpananRecord) {
            $simpananRecord->simpanan_saldo = $simpanan_saldo;
            $simpananRecord->save();
        } else {
            $simpananRecord = new SimpananSaldo();
            $simpananRecord->user_id = $simpanan->user_id;
            $simpananRecord->simpanan_saldo = $simpanan_saldo;
            $simpananRecord->save();
        }

        $saldo = Saldo::where('user_id', $simpanan->user_id)->value('saldo') ?? 0;
        $saldo -= $simpanan->jum_simpanan;
        if ($simpanan->j_simpanan === 'pokok') {
            $saldo -= 50000;
        }
        else if($simpanan->j_simpanan === 'wajib'){
            $saldo -= 100;
        }
        else
        {
            $saldo -= 0;
        }
        $saldoRecord = Saldo::where('user_id', $simpanan->user_id)->first();

        if ($saldoRecord) {
            $saldoRecord->saldo = $saldo;
            $saldoRecord->save();
        }

        return redirect()->back()->with('success', 'Simpanan transaksi telah disetujui.');
    }


    public function reject(Request $request, $id)
    {
        $simpanan = Simpanan::findOrFail($id);

        SimpananApproval::create([
            'simpanan_id' => $simpanan->id,
            'status' => 'rejected',
            'note' => $request->note
        ]);

        $simpanan->delete();

        return redirect()->back()->with('success', 'Simpanan transaksi telah ditolak.');
    }
}