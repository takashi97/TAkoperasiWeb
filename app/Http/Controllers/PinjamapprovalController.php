<?php

namespace App\Http\Controllers;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\SimpananSaldo;
use App\Models\KoperasiSaldocontrol;
use App\Models\Saldo;
use App\Models\Rekber;
use App\Models\PinjamanApproval;
use Illuminate\Http\Request;

class PinjamapprovalController extends Controller
{
    /*public function index(Request $request)
    {
        $pinjamans = [];

        if (Pinjaman::count() > 0) {
            $pinjamans = Pinjaman::where('approved', false)->get();
        }
        
        return view('koperasi.koperasipinjamapproval', compact('pinjamans'));
    }
    */

    public function approve(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->approved = true;
        $pinjaman->save();

        $pinjamanApproval = PinjamanApproval::where('pinjaman_id', $pinjaman->id)->first();
        $pinjamanApproval->status = 'approved';
        $pinjamanApproval->note = $request->note;
        $pinjamanApproval->save();

        $saldocontrol = new KoperasiSaldocontrol();
        $saldocontrol->user_id = $pinjaman->user_id;
        $saldocontrol->saldo_control = $pinjaman->jum_pinjaman;
        $saldocontrol->keterangan = 'Saldo_Tambah';
        $saldocontrol->save();

        $simpanan = Simpanan::where('user_id', $pinjaman->user_id)->sum('jum_simpanan');
        $saldocontrolTambah = KoperasiSaldocontrol::where('user_id', $pinjaman->user_id)->where('keterangan', 'Saldo_Tambah')->sum('saldo_control');
        $simpanan_saldo = $simpanan - $saldocontrolTambah;

        $simpananRecord = SimpananSaldo::where('user_id', $pinjaman->user_id)->first();
        if ($simpananRecord) {
            $simpananRecord->simpanan_saldo = $simpanan_saldo;
            $simpananRecord->save();
        } else {
            $simpananRecord = new SimpananSaldo();
            $simpananRecord->user_id = $pinjaman->user_id;
            $simpananRecord->simpanan_saldo = $simpanan_saldo;
            $simpananRecord->save();
        }


        $saldo = Saldo::where('user_id', $pinjaman->user_id)->value('saldo');
        $feepinjam = $pinjaman->jum_pinjaman;
        $feepinjam = $feepinjam * 0.05;
        $saldo += $pinjaman->jum_pinjaman;
        $saldo -= $feepinjam;
        
        $rekber = Rekber::first();
        $rekber->rekber_saldo += $feepinjam;
        $rekber->save();

        $saldoRecord = Saldo::where('user_id', $pinjaman->user_id)->first();
        if ($saldoRecord) {
            $saldoRecord->saldo = $saldo;
            $saldoRecord->save();
        }

        return redirect()->back()->with('success', 'Pinjaman transaksi telah disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        PinjamanApproval::create([
            'pinjaman_id' => $pinjaman->id,
            'status' => 'rejected',
            'note' => $request->note
        ]);

        $pinjaman->delete();

        return redirect()->back()->with('success', 'Pinjaman transaksi telah ditolak.');
    }
}