<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowpinjamanController extends Controller
{
    public function index2()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $pinjamans = Pinjaman::all();
            return view('koperasi.koperasipinjam', compact('pinjamans'));
        } elseif ($user->level == 'member' || $user->level == 'umkm') {
            $pinjamans = Pinjaman::with('user')->get();
            return view('koperasi.koperasipinjam', compact('pinjamans'));
        }
    }
}