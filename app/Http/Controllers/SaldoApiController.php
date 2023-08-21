<?php

namespace App\Http\Controllers;
use App\Models\Saldo;
use Illuminate\Http\Request;

class SaldoApiController extends Controller
{
    public function show($userId)
    {
        $saldo = Saldo::where('user_id', $userId)->value('saldo');
        
        return response()->json($saldo);
    }
}
