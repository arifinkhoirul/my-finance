<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
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

    public function editSelfReward(int $id)
    {
        $user = Auth::user();
        $dataTransaksi = Transaction::with('wallet', 'category')->find($id);

        return Inertia::render('SelfReward/Edit', ['dataTransaksi' => $dataTransaksi, 'user' => $user]);
    }

    public function updateSelfReward(Request $request, int $id)
    {
        $data = Transaction::find($id);

        $validated = $request->validate([
            'user_id' => 'required',
            'wallet_id' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'description' => 'required',
        ], [
            'user_id.requried' => 'masukkan data dengan benar',
            'wallet_id.requried' => 'masukkan data dengan benar',
            'category_id.requried' => 'masukkan data dengan benar',
            'type.requried' => 'masukkan data dengan benar',
            'amount.requried' => 'masukkan data dengan benar',
            'date.requried' => 'masukkan data dengan benar',
            'description.requried' => 'masukkan data dengan benar',
        ]);

        $validated['date'] = Carbon::parse($validated['date'],'UTC'
        )->setTimezone('Asia/Jakarta')->toDateString();

        $data->update($validated);

        return redirect()->route('self.reward.all')->with(['message' => 'Kamu berhasil mengubah data self reward']);
    }
}
