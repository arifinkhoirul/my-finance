<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('category', 'wallet')->orderBy('date', 'desc')->get();
        $wallets = Wallet::latest()->get();

        $walletInvestment = Transaction::where('wallet_id', 3)->sum('amount');
        $totalIncome = Transaction::where('wallet_id', 1)->sum('amount');
        $totalExpenses = Transaction::where('wallet_id', 2)->sum('amount');
        $totalSelfReward = Transaction::where('wallet_id', 4)->sum('amount');

        $walletIncome = Transaction::where('wallet_id', 1)->whereMonth('created_at', Carbon::now())->whereYear('created_at', Carbon::now())->sum('amount');
        $walletExpenses = Transaction::where('wallet_id', 2)->whereMonth('created_at', Carbon::now())->whereYear('created_at', Carbon::now())->sum('amount');

        $walletCash = $totalIncome - $walletInvestment - $totalExpenses - $totalSelfReward;
        $saldoUtama = $totalIncome  - $totalSelfReward - $totalExpenses;
        // $ = Transaction::latest()->get();
        // dd($transactions);

        return Inertia::render('Financial', ['transactions' => $transactions, 'wallets' => $wallets, 'walletInvestment' => $walletInvestment, 'walletExpenses' => $walletExpenses, 'walletCash' => $walletCash, 'totalIncome' => $totalIncome, 'totalSelfReward' => $totalSelfReward, 'walletIncome' => $walletIncome, 'saldoUtama' => $saldoUtama]);
    }
}
