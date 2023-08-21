<?php

namespace App\Http\Controllers;
use App\Models\Penarikan;
use App\Models\Simpanan;
use App\Models\SimpananSaldo;
use App\Models\KoperasiSaldocontrol;
use App\Models\Saldo;
use App\Models\PenarikanApproval;
use Illuminate\Http\Request;

class PenarikanapprovalController extends Controller
{
    /*public function index(Request $request)
    {
        $penarikans = [];

        if (Penarikan::count() > 0) {
            $penarikans = Penarikan::where('approved', false)->get();
        }
        
        return view('koperasi.koperasipenarikanapproval', compact('penarikans'));
    }
    */
    
    public function approve(Request $request, $id)
    {
        $penarikan = Penarikan::findOrFail($id);
        $penarikan->approved = true;
        $penarikan->save();

        $penarikanApproval = PenarikanApproval::where('penarikan_id', $penarikan->id)->first();
        $penarikanApproval->status = 'approved';
        $penarikanApproval->note = $request->note;
        $penarikanApproval->save();
        
        $saldocontrol = new KoperasiSaldocontrol();
        $saldocontrol->user_id = $penarikan->user_id;
        $saldocontrol->saldo_control = $penarikan->jum_penarikan;
        $saldocontrol->keterangan = 'Saldo_Tambah';
        $saldocontrol->save();

        $simpanan = Simpanan::where('user_id', $penarikan->user_id)->sum('jum_simpanan');
        $saldocontrolTambah = KoperasiSaldocontrol::where('user_id', $penarikan->user_id)->where('keterangan', 'Saldo_Tambah')->sum('saldo_control');
        $simpanan_saldo = $simpanan - $saldocontrolTambah;
        
        $simpananRecord = SimpananSaldo::where('user_id', $penarikan->user_id)->first();
        if ($simpananRecord) {
            $simpananRecord->simpanan_saldo = $simpanan_saldo;
            $simpananRecord->save();
        } else {
            $simpananRecord = new SimpananSaldo();
            $simpananRecord->user_id = $penarikan->user_id;
            $simpananRecord->simpanan_saldo = $simpanan_saldo;
            $simpananRecord->save();
        }

        $saldo = Saldo::where('user_id', $penarikan->user_id)->value('saldo') ?? 0;
        $saldo += $penarikan->jum_penarikan;

        $saldoRecord = Saldo::where('user_id', $penarikan->user_id)->first();
        if ($saldoRecord) {
            $saldoRecord->saldo = $saldo;
            $saldoRecord->save();
        }

        return redirect()->back()->with('success', 'Penarikan transaction has been approved.');
    }

    public function reject(Request $request, $id)
    {
        $penarikan = Penarikan::findOrFail($id);
    
        PenarikanApproval::create([
            'penarikan_id' => $penarikan->id, // add a check to make sure the user is present
            'status' => 'rejected',
            'note' => $request->note
        ]);
    
        $penarikan->delete();
    
        return redirect()->back()->with('success', 'Penarikan transaction has been rejected.');
    }
}