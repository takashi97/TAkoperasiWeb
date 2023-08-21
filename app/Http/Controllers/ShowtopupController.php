<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowtopupController extends Controller
{
    public function index4()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $topups = Topup::all();
            return view('koperasi.koperasitopup', compact('topups'));
        } elseif ($user->level == 'member' || $user->level == 'umkm') {
            $topups = Topup::where('user')->get();
            return view('koperasi.koperasitopup', compact('topups'));
        }
    }
}