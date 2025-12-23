<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InputDataController extends Controller
{
    public function createPemasukan()
    {
        return Inertia::render('Pemasukan/Create');
    }

    public function storePemasukan(Request $request)
    {
        // dd($request->date);


        $validated = $request->validate([
            'user_id' => 'required',
            'wallet_id' => 'required',
            'category_id' => 'required',
            // 'type' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required',
        ], [
            'user_id.requried' => 'masukkan data dengan benar',
            'wallet_id.requried' => 'masukkan data dengan benar',
            'category_id.requried' => 'masukkan data dengan benar',
            // 'type.requried' => 'masukkan data dengan benar',
            'amount.requried' => 'masukkan data dengan benar',
            'description.requried' => 'masukkan data dengan benar',
            'date.requried' => 'masukkan data dengan benar',
        ]);


        $validated['date'] = Carbon::parse($validated['date'],'UTC'
        )->setTimezone('Asia/Jakarta')->toDateString();

        Transaction::create($validated);

        return redirect()->route('financial.dashboard')->with(['message' => 'Kamu berhasil menambahkan pemasukan']);
    }

    public function createInvestasi()
    {
        return Inertia::render('Investasi/Create');
    }

    public function storeInvestasi(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'wallet_id' => 'required',
            'category_id' => 'required',
            // 'type' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required',
        ], [
            'user_id.requried' => 'masukkan data dengan benar',
            'wallet_id.requried' => 'masukkan data dengan benar',
            'category_id.requried' => 'masukkan data dengan benar',
            // 'type.requried' => 'masukkan data dengan benar',
            'amount.requried' => 'masukkan data dengan benar',
            'description.requried' => 'masukkan data dengan benar',
            'date.requried' => 'masukkan data dengan benar',
        ]);

        $validated['date'] = Carbon::parse($validated['date'],'UTC'
        )->setTimezone('Asia/Jakarta')->toDateString();

        Transaction::create($validated);

        return redirect()->route('financial.dashboard')->with(['message' => 'Kamu berhasil menambah investasi']);
    }


    public function createSelfReward()
    {
        return Inertia::render('SelfReward/Create');
    }

    public function storeSelfReward(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'wallet_id' => 'required',
            'category_id' => 'required',
            // 'type' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required',
        ], [
            'user_id.requried' => 'masukkan data dengan benar',
            'wallet_id.requried' => 'masukkan data dengan benar',
            'category_id.requried' => 'masukkan data dengan benar',
            // 'type.requried' => 'masukkan data dengan benar',
            'amount.requried' => 'masukkan data dengan benar',
            'description.requried' => 'masukkan data dengan benar',
            'date.requried' => 'masukkan data dengan benar',
        ]);

        $validated['date'] = Carbon::parse($validated['date'],'UTC'
        )->setTimezone('Asia/Jakarta')->toDateString();

        Transaction::create($validated);

        return redirect()->route('financial.dashboard')->with(['message' => 'Kamu berhasil menambahkan self reward']);
    }
}
