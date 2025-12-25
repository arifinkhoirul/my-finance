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


    public function deleteSelfReward(int $id)
    {
        if(Auth::check()) {

            $dataTransaksi = Transaction::findOrFail($id);
            // dd($dataTransaksi);

            $dataTransaksi->delete();

            return redirect()->route('self.reward.all')->with(['message' => 'Kamu berhasil menghapus data']);
        }
    }
}
