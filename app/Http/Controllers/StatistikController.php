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

        //---------------------------------------------------------------------------------------------------------------------------------
        //
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
        // -----------------------------------------------------------------------------------------------------------------------------------







        //--------------------------------------------------------------------------------------------------------------------------
        $totalIncome = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');
        $totalInvestment = Transaction::where('user_id', $user->id)->where('type', 'investment')->sum('amount');
        $totalExpenses = Transaction::where('user_id', $user->id)->where('type', 'expenses')->sum('amount');
        $totalSelfReward = Transaction::where('user_id', $user->id)->where('type', 'self-reward')->sum('amount');
        $totalCash = $totalIncome - $totalInvestment - $totalExpenses - $totalSelfReward;

        $totalSaldo = $totalCash + $totalInvestment;
        // -------------------------------------------------------------------------------------------------------------------------




        // ---------------------------------------------------------------------------------------------------------------------------------------------------------------
        // ambil data bertype expenses dari tiap tiap category di 4 bulan teraarkhir
        $expensesFoodMonthFourth = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 20)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->sum('amount');

        $expensesTransportationMonthFourth = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 21)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->sum('amount');

        $expensesTagihanMonthFourth = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 22)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->sum('amount');

        $expensesHealthMonthFourth = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 23)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->sum('amount');

        $expensesEducationMonthFourth = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 24)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->sum('amount');

        $expensesOtherMonthFourth = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 25)->whereMonth('date', $monthFourth->month)->whereYear('date', $monthFourth->year)->sum('amount');


        // ambil data bertype expenses dari tiap tiap category di 3 bulan teraarkhir
        $expensesFoodMontThird = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 20)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->sum('amount');

        $expensesTransportationMontThird = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 21)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->sum('amount');

        $expensesTagihanMontThird = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 22)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->sum('amount');

        $expensesHealthMontThird = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 23)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->sum('amount');

        $expensesEducationMontThird = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 24)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->sum('amount');

        $expensesOtherMontThird = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 25)->whereMonth('date', $monthThird->month)->whereYear('date', $monthThird->year)->sum('amount');


        // ambil data bertype expenses dari tiap tiap category di 2 bulan teraarkhir
        $expensesFoodMontSecond = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 20)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->sum('amount');

        $expensesTransportationMontSecond = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 21)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->sum('amount');

        $expensesTagihanMontSecond = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 22)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->sum('amount');

        $expensesHealthMontSecond = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 23)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->sum('amount');

        $expensesEducationMontSecond = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 24)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->sum('amount');

        $expensesOtherMontSecond = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 25)->whereMonth('date', $monthSecond->month)->whereYear('date', $monthSecond->year)->sum('amount');


        // ambil data bertype expenses dari tiap tiap category di bulan ini
        $expensesFoodMontNow = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 20)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->sum('amount');

        $expensesTransportationMontNow = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 21)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->sum('amount');

        $expensesTagihanMontNow = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 22)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->sum('amount');

        $expensesHealthMontNow = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 23)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->sum('amount');

        $expensesEducationMontNow = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 24)->whereMonth('date', $monthNow->month)->whereYear('date', $monthNow->year)->sum('amount');

        $expensesOtherMontNow = Transaction::where('user_id', $user->id)->where('type', 'expenses')->where('category_id', 25)->whereMonth('date', $monthNow->month)->whereYear('date', $monthSecond->year)->sum('amount');

        // dd($expensesTransportationMontNow);






        return Inertia::render('Statistik/Index', ['saldoTrendMonthFourth' => $saldoTrendMonthFourth, 'saldoTrendMonthThird' => $saldoTrendMonthThird, 'saldoTrendMonthSecond' => $saldoTrendMonthSecond, 'saldoTrendMonthNow' => $saldoTrendMonthNow, 'totalInvestment' => $totalInvestment, 'totalCash' => $totalCash, 'expensesDataLastMothFourth' => $expensesDataLastMothFourth, 'expensesDataLastMothThird' => $expensesDataLastMothThird, 'expensesDataLastMothSecond' => $expensesDataLastMothSecond, 'expensesDataLastMothNow' => $expensesDataLastMothNow, 'selfRewardDataLastMothFourth' => $selfRewardDataLastMothFourth, 'selfRewardDataLastMothThird' => $selfRewardDataLastMothThird, 'selfRewardDataLastMothSecond' => $selfRewardDataLastMothSecond, 'selfRewardDataLastMothNow' =>  $selfRewardDataLastMothNow, 'totalSaldo' => $totalSaldo, 'totalExpenses' => $totalExpenses, 'expensesFoodMonthFourth' => $expensesFoodMonthFourth, 'expensesTransportationMonthFourth' => $expensesTransportationMonthFourth, 'expensesTagihanMonthFourth' => $expensesTagihanMonthFourth, 'expensesHealthMonthFourth' => $expensesHealthMonthFourth, 'expensesEducationMonthFourth' => $expensesEducationMonthFourth, 'expensesOtherMonthFourth' => $expensesOtherMonthFourth, 'expensesTransportationMontThird' => $expensesTransportationMontThird, 'expensesTagihanMontThird' => $expensesTagihanMontThird, 'expensesHealthMontThird' => $expensesHealthMontThird, 'expensesEducationMontThird' => $expensesEducationMontThird, 'expensesOtherMontThird' => $expensesOtherMontThird, 'expensesFoodMontThird' => $expensesFoodMontThird, 'expensesFoodMontSecond' => $expensesFoodMontSecond, 'expensesTransportationMontSecond' => $expensesTransportationMontSecond, 'expensesTagihanMontSecond' => $expensesTagihanMontSecond, 'expensesHealthMontSecond' => $expensesHealthMontSecond, 'expensesEducationMontSecond' => $expensesEducationMontSecond, 'expensesOtherMontSecond' => $expensesOtherMontSecond, 'expensesFoodMontNow' => $expensesFoodMontNow, 'expensesTransportationMontNow' => $expensesTransportationMontNow, 'expensesTagihanMontNow' => $expensesTagihanMontNow, 'expensesHealthMontNow' => $expensesHealthMontNow, 'expensesEducationMontNow' => $expensesEducationMontNow, 'expensesOtherMontNow' => $expensesOtherMontNow]);
    }
}
