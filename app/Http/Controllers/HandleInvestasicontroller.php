<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandleInvestasicontroller extends Controller
{
    public function allInvestasi()
    {
        $user = Auth::user();

        $allInvestasi = Transaction::with('category', 'wallet')->where('user_id', $user->id)->where('type', 'investment')->orderBy('date', 'DESC')->get();
        $jumlahAllnvestasi = Transaction::where('user_id', $user->id)->where('type', 'investment')->sum('amount');

        // dd($allInvestasi);

        return Inertia::render('Investasi/Index', ['allInvestasi' => $allInvestasi, 'jumlahAllnvestasi' => $jumlahAllnvestasi]);
    }
}
