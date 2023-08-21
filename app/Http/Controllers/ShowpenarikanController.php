<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowpenarikanController extends Controller
{
    public function index3()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $penarikans = Penarikan::all();
            return view('koperasi.koperasipenarikan', compact('penarikans'));
        } elseif ($user->level == 'member' || $user->level == 'umkm') {
            $penarikans = Penarikan::with('user')->get();
            return view('koperasi.koperasipenarikan', compact('penarikans'));
        }
    }
}