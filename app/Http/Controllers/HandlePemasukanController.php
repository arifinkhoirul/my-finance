<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandlePemasukanController extends Controller
{
    public function allPemeasukan()
    {
        $user = Auth::user();

        $allPemasukan = Transaction::with('category', 'wallet')->where('user_id', $user->id)->where('type', 'income')->orderBy('date', 'DESC')->get();
        $jumlahPemasuakan = Transaction::where('user_id', $user->id)->where('type', 'income')->sum('amount');

        // dd($allInvestasi);

        return Inertia::render('Pemasukan/Index', ['allPemasukan' => $allPemasukan, 'jumlahPemasuakan' => $jumlahPemasuakan]);
    }

    public function deletePemasukan(int $id)
    {
        if(Auth::check()) {

            $dataTransaksi = Transaction::findOrFail($id);
            // dd($dataTransaksi);

            $dataTransaksi->delete();

            return redirect()->route('pemasukan.all')->with(['message' => 'Kamu berhasil menghapus data']);
        }
    }

    public function editPemasukan(int $id)
    {
        $user = Auth::user();
        $dataTransaksi = Transaction::with('wallet', 'category')->find($id);

        return Inertia::render('Pemasukan/Edit', ['dataTransaksi' => $dataTransaksi, 'user' => $user]);
    }

    public function updatePemasukan(Request $request, int $id)
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

        return redirect()->route('pemasukan.all')->with(['message' => 'Kamu berhasil mengubah data pemasukan']);
    }
}
