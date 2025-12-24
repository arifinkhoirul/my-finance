<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StatistikController extends Controller
{
    public function indexStatistik()
    {
        $user = Auth::user();
        // tren saldo
        $monthFourth = Carbon::now()->subMonth(3);
        $monthThird = Carbon::now()->subMonth(2);
        $monthSecond = Carbon::now()->subMonth(1);
        $monthNow = Carbon::now()->subMonth(0);

        // ambil data BULAN KE 4 dari bulan sekarang-------------------------------------------------------------------------------------------
        $expensesDataLastMothFourth = Transaction::where('user_id', $user->id)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->where('type', 'expenses')->sum('amount');
        $selfRewardDataLastMothFourth = Transaction::where('user_id', $user->id)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->where('type', 'self-reward')->sum('amount');
        $incomeDataLastMothFourth = Transaction::where('user_id', $user->id)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->where('type', 'income')->sum('amount');

        $saldoTrendMonthFourth = $incomeDataLastMothFourth - $expensesDataLastMothFourth - $selfRewardDataLastMothFourth;


        // ambil data BULAN KE 3 dari bulan sekarang--------------------------------------------------------------------------------------------
        $expensesDataLastMothThird = Transaction::where('user_id', $user->id)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->where('type', 'expenses')->sum('amount');
        $selfRewardDataLastMothThird = Transaction::where('user_id', $user->id)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->where('type', 'self-reward')->sum('amount');
        $incomeDataLastMothThird = Transaction::where('user_id', $user->id)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->where('type', 'income')->sum('amount');

        $saldoTrendMonthThird = $incomeDataLastMothThird - $expensesDataLastMothThird - $selfRewardDataLastMothThird;


        // ambil data BULAN KE 2 dari bulan sekarang--------------------------------------------------------------------------------------------
        $expensesDataLastMothSecond = Transaction::where('user_id', $user->id)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->where('type', 'expenses')->sum('amount');
        $selfRewardDataLastMothSecond = Transaction::where('user_id', $user->id)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->where('type', 'self-reward')->sum('amount');
        $incomeDataLastMothSecond = Transaction::where('user_id', $user->id)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->where('type', 'income')->sum('amount');

        $saldoTrendMonthSecond = $incomeDataLastMothSecond - $expensesDataLastMothSecond - $selfRewardDataLastMothSecond;


        // ambil data BULAN sekarang--------------------------------------------------------------------------------------------
        $expensesDataLastMothNow = Transaction::where('user_id', $user->id)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->where('type', 'expenses')->sum('amount');
        $selfRewardDataLastMothNow = Transaction::where('user_id', $user->id)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->where('type', 'self-reward')->sum('amount');
        $incomeDataLastMothNow = Transaction::where('user_id', $user->id)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->where('type', 'income')->sum('amount');

        $saldoTrendMonthNow = $incomeDataLastMothNow - $expensesDataLastMothNow - $selfRewardDataLastMothNow;

        //
        $totalIncome = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');
        $totalInvestment = Transaction::where('user_id', $user->id)->where('type', 'investment')->sum('amount');
        $totalExpenses = Transaction::where('user_id', $user->id)->where('type', 'expenses')->sum('amount');
        $totalSelfReward = Transaction::where('user_id', $user->id)->where('type', 'self-reward')->sum('amount');
        $totalCash = $totalIncome - $totalInvestment - $totalExpenses - $totalSelfReward;


        // dd($user->id);

        return Inertia::render('Statistik/Index', ['saldoTrendMonthFourth' => $saldoTrendMonthFourth, 'saldoTrendMonthThird' => $saldoTrendMonthThird, 'saldoTrendMonthSecond' => $saldoTrendMonthSecond, 'saldoTrendMonthNow' => $saldoTrendMonthNow, 'totalInvestment' => $totalInvestment, 'totalCash' => $totalCash, 'expensesDataLastMothFourth' => $expensesDataLastMothFourth, 'expensesDataLastMothThird' => $expensesDataLastMothThird, 'expensesDataLastMothSecond' => $expensesDataLastMothSecond, 'expensesDataLastMothNow' => $expensesDataLastMothNow]);
    }
}
