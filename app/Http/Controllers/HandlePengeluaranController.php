<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandlePengeluaranController extends Controller
{
    public function allpengeluaran()
    {
        $user = Auth::user();

        $allPengeluaran = Transaction::with('category', 'wallet')->where('user_id', $user->id)->where('type', 'expenses')->get();
        $jumlahPengeluaran = Transaction::where('user_id', $user->id)->where('type', 'expenses')->sum('amount');

        // dd($allInvestasi);

        return Inertia::render('Pengeluaran/Index', ['allPengeluaran' => $allPengeluaran, 'jumlahPengeluaran' => $jumlahPengeluaran]);
    }
}
