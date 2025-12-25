<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandlePemasukanController extends Controller
{
    public function allPemeasukan()
    {
        $user = Auth::user();

        $allPemasukan = Transaction::with('category', 'wallet')->where('user_id', $user->id)->where('type', 'income')->get();
        $jumlahPemasuakan = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');

        // dd($allInvestasi);

        return Inertia::render('Pemasukan/Index', ['allPemasukan' => $allPemasukan, 'jumlahPemasuakan' => $jumlahPemasuakan]);
    }
}
