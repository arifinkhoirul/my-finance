<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::where('user_id', $user->id)->with('category', 'wallet')->orderBy('date', 'desc')->paginate(10);
        $wallets = Wallet::where('user_id', $user->id)->latest()->get();

        $walletInvestment = Transaction::where('user_id', $user->id)->where('wallet_id', 3)->sum('amount');
        $totalIncome = Transaction::where('user_id', $user->id)->where('wallet_id', 1)->sum('amount');
        $totalExpenses = Transaction::where('user_id', $user->id)->where('wallet_id', 2)->sum('amount');
        $totalSelfReward = Transaction::where('user_id', $user->id)->where('wallet_id', 4)->sum('amount');

        $walletIncome = Transaction::where('user_id', $user->id)->where('wallet_id', 1)->whereMonth('date', Carbon::now())->whereYear('date', Carbon::now())->sum('amount');
        $walletExpenses = Transaction::where('user_id', $user->id)->where('wallet_id', 2)->whereMonth('date', Carbon::now())->whereYear('date', Carbon::now())->sum('amount');

        $walletCash = $totalIncome - $walletInvestment - $totalExpenses - $totalSelfReward;
        $saldoUtama = $totalIncome  - $totalSelfReward - $totalExpenses;
        // $ = Transaction::latest()->get();
        // $user =  Auth::user();
        // dd($walletIncome);

        return Inertia::render('Financial', ['user' => $user,'transactions' => $transactions, 'wallets' => $wallets, 'walletInvestment' => $walletInvestment, 'walletExpenses' => $walletExpenses, 'walletCash' => $walletCash, 'totalIncome' => $totalIncome, 'totalSelfReward' => $totalSelfReward, 'walletIncome' => $walletIncome, 'saldoUtama' => $saldoUtama]);
    }
}
