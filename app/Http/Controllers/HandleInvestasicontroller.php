<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandleInvestasicontroller extends Controller
{
    public function allInvestasi()
    {
        $user = Auth::user();

        $allInvestasi = Transaction::with('category', 'wallet')->where('user_id', $user->id)->where('type', 'investment')->orderBy('date', 'DESC')->get();
        $jumlahAllnvestasi = Transaction::where('user_id', $user->id)->where('type', 'investment')->sum('amount');

        // dd($allInvestasi);

        return Inertia::render('Investasi/Index', ['allInvestasi' => $allInvestasi, 'jumlahAllnvestasi' => $jumlahAllnvestasi]);
    }

    public function deleteInvestasi(int $id)
    {
         if(Auth::check()) {

            $dataTransaksi = Transaction::findOrFail($id);
            // dd($dataTransaksi);

            $dataTransaksi->delete();

            return redirect()->route('investasi.all')->with(['message' => 'Kamu berhasil menghapus data']);
        }
    }
}
