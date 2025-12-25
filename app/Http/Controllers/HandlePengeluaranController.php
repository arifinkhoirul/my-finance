<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandlePengeluaranController extends Controller
{
    public function allpengeluaran()
    {
        $user = Auth::user();

        $allPengeluaran = Transaction::with('category', 'wallet')->where('user_id', $user->id)->where('type', 'expenses')->orderBy('date', 'DESC')->get();
        $jumlahPengeluaran = Transaction::where('user_id', $user->id)->where('type', 'expenses')->sum('amount');

        // dd($allInvestasi);

        return Inertia::render('Pengeluaran/Index', ['allPengeluaran' => $allPengeluaran, 'jumlahPengeluaran' => $jumlahPengeluaran]);
    }


    public function deletePengeluaran(int $id)
    {
        $user = Auth::user();

        $dataTransaksi = Transaction::findOrFail($id);
        // dd($dataTransaksi);

        $dataTransaksi->delete();

        return redirect()->route('pengeluaran.all')->with(['message' => 'Kamu berhasil menghapus data']);
    }

    public function editPengeluaran(int $id)
    {
        $user = Auth::user();
        $dataTransaksi = Transaction::with('wallet', 'category')->find($id);

        return Inertia::render('Pengeluaran/Edit', ['dataTransaksi' => $dataTransaksi, 'user' => $user]);
    }

    public function updatePengeluaran(Request $request, int $id)
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

        return redirect()->route('pengeluaran.all')->with(['message' => 'Kamu berhasil mengubah data pengeluaran']);
    }
}
