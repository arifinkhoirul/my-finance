<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InputDataController extends Controller
{
    public function createPemasukan()
    {
        $user = Auth::user();
        return Inertia::render('Pemasukan/Create', ['user' => $user]);
    }

    public function storePemasukan(Request $request)
    {
        // dd($request->date);


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

        Transaction::create($validated);

        return redirect()->route('financial.dashboard')->with(['message' => 'Kamu berhasil menambahkan pemasukan']);
    }



    public function createInvestasi()
    {
        $user = Auth::user();
        return Inertia::render('Investasi/Create', ['user' => $user]);
    }

    public function storeInvestasi(Request $request)
    {
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

        Transaction::create($validated);

        return redirect()->route('financial.dashboard')->with(['message' => 'Kamu berhasil menambah investasi']);
    }






    public function createSelfReward()
    {
        $user = Auth::user();
        return Inertia::render('SelfReward/Create', ['user' => $user]);
    }

    public function storeSelfReward(Request $request)
    {
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

        Transaction::create($validated);

        return redirect()->route('financial.dashboard')->with(['message' => 'Kamu berhasil menambahkan self reward']);
    }


    public function createPengeluaran()
    {
        $user = Auth::user();
        return Inertia::render('Pengeluaran/Create', ['user' => $user]);
    }

    public function storePengeluaran(Request $request)
    {
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

        Transaction::create($validated);

        return redirect()->route('financial.dashboard')->with(['message' => 'Kamu berhasil menambahkan pengeluaran']);

    }
}
