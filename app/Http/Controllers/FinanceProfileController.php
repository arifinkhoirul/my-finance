<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FinanceProfileController extends Controller
{
    public function myProfile()
    {
        $user = Auth::user();
        $userName = $user->name;
        $userEmail = $user->email;
        $userBergabung = $user->created_at;

        $totalTransaksi = Transaction::where('user_id', $user->id)->count();

        // dd($totalTransaksi);

        return Inertia::render('NewProfile/Index', ['userName' => $userName, 'userEmail' => $userEmail, 'userBergabung' => $userBergabung, 'totalTransaksi' => $totalTransaksi]);
    }
}
