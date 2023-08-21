<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Penarikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowsimpananController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $simpanans = Simpanan::all();
            return view('koperasi.koperasisimpan', compact('simpanans'));
        } elseif ($user->level == 'member' || $user->level == 'umkm') {
            $simpanans = Simpanan::where('user_id', $user->id)
                ->where('approved', true)
                ->get();
            return view('koperasi.koperasisimpan', compact('simpanans'));
        }
    }

    public function index2(Request $request)
    {
        $user = Auth::user();
        $simpanans = [];
        $pinjamans = [];
        $penarikans = [];

        if ($user->level == 'admin') {
            $simpanans = Simpanan::all();
            $pinjamans = Pinjaman::all();
            $penarikans = Penarikan::all();
        } elseif ($user->level == 'member' || $user->level == 'umkm'){
            $simpanans = Simpanan::where('user_id', $user->id)
                ->where('approved', true)
                ->get();
            $pinjamans = Pinjaman::where('user_id', $user->id)
                ->where('approved', true)
                ->get();
            $penarikans = Penarikan::where('user_id', $user->id)
                ->where('approved', true)
                ->get();
        }
    
        return view('koperasi.user.koperasihomeuser', compact(['simpanans','penarikans','pinjamans']));
    }

    public function index3(Request $request)
    {
        $user = Auth::user();
        $simpanans = [];
        $pinjamans = [];
        $penarikans = [];

        if ($user->level == 'admin') {
            $simpanans = Simpanan::all();
            $pinjamans = Pinjaman::all();
            $penarikans = Penarikan::all();
        } elseif ($user->level == 'member' || $user->level == 'umkm'){
            $simpanans = Simpanan::where('user_id', $user->id)
                ->where('approved', true)
                ->get();
            $pinjamans = Pinjaman::where('user_id', $user->id)
                ->where('approved', true)
                ->get();
            $penarikans = Penarikan::where('user_id', $user->id)
                ->where('approved', true)
                ->get();
        }
    
        return view('koperasi.koperasilaporan', compact(['simpanans','penarikans','pinjamans']));
    }

    public function showanggota(Request $request)
    {
        $user = Auth::user();
        $users = [];


        if ($user->level == 'admin') {
            $users = User::all();

        }     
        return view('koperasi.koperasianggota', compact(['users']));
    }
}





