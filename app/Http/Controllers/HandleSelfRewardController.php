<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandleSelfRewardController extends Controller
{
    public function allSelfReward()
    {
        $user = Auth::user();

        $allSelfReward = Transaction::with('category', 'wallet')->where('user_id', $user->id)->where('type', 'self-reward')->orderBy('date', 'DESC')->get();
        $jumlahSelfReward = Transaction::where('user_id', $user->id)->where('type', 'self-reward')->sum('amount');

        // dd($allSelfReward);

        return Inertia::render('SelfReward/Index', ['allSelfReward' => $allSelfReward, 'jumlahSelfReward' => $jumlahSelfReward]);
    }
}
