<?php

namespace App\Http\Controllers;
use App\Models\Topup;
use App\Models\Saldo;
use App\Models\TopupApproval;
use App\Models\KoperasiSaldocontrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopupapprovalController extends Controller
{
    public function index4()
    {
        $user = Auth::user();

        if ($user->level == 'admin') {
            $topups = Topup::all();
            return view('koperasi.koperasitopup', compact('topups'));
        } elseif ($user->level == 'member' || $user->level == 'umkm') {
            $topups = Topup::where('user_id', $user->id)
                ->where('approved', true)
                ->get();    
            return view('koperasi.koperasitopup', compact('topups'));
        }
    }

    public function approve(Request $request, $id)
    {
        $topup = Topup::findOrFail($id);
        $user_id = $topup->user_id;
        $topup->jum_topup;
        $topup->approved = true;
        $topup->save();

        $topupApproval = TopupApproval::where('topup_id', $topup->id)->first();
        $topupApproval->status = 'approved';
        $topupApproval->note = $request->note;
        $topupApproval->save();

        $topups = Topup::where('user_id', $user_id)->where('approved', true)->get();
        $saldocontrolKurang = KoperasiSaldocontrol::where('user_id', $user_id)->where('keterangan', 'Saldo_Kurang')->sum('saldo_control');
        $saldocontrolTambah = KoperasiSaldocontrol::where('user_id', $user_id)->where('keterangan', 'Saldo_Tambah')->sum('saldo_control');
        if ($saldocontrolKurang) {
            $saldo = $topups->sum('jum_topup');
            $saldo -= $saldocontrolKurang;
        }elseif ($saldocontrolTambah) {
            $saldo = $topups->sum('jum_topup');
            $saldo += $saldocontrolTambah;
        }
        else{
            $saldo = $topups->sum('jum_topup');
        }

        $saldoRecord = Saldo::where('user_id', $user_id)->first();
        if ($saldoRecord) {
            $saldoRecord->saldo = $saldo;
            $saldoRecord->save();
        } else {
            $saldoRecord = new Saldo();
            $saldoRecord->user_id = $user_id;
            $saldoRecord->saldo = $saldo;
            $saldoRecord->save();
        }

        return redirect()->back()->with('success', 'Topup has been approved.');
    }

    public function reject(Request $request, $id)
    {
        $topup = Topup::findOrFail($id);
    
        TopupApproval::create([
            'topup_id' => $topup->id, // add a check to make sure the user is present
            'status' => 'rejected',
            'note' => $request->note
        ]);
    
        $topup->delete();
    
        return redirect()->back()->with('success', 'Topup has been rejected.');
    }

}