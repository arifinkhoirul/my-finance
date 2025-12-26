<?php

namespace App\Http\Controllers;

use App\Models\KritikDanSaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DukunganController extends Controller
{
    public function indexDukungan()
    {
        $user = Auth::user();
        return Inertia::render('Dukungan/Index', ['user' => $user]);
    }


    public function storeDukungan(Request $request)
    {
        $user = Auth::user();
        // dd($request);

        $validated = $request->validate([
            'user_id' => 'required',
            'nama_samaran' => 'required',
            'description' => 'required',

        ],
        [
            // 'nama_samaran' => 'required',
            'description.required' => 'Masukkan kritik atau saran anda',
        ]);

        KritikDanSaran::create($validated);

        return redirect()->route('dukungan.index')->with(['message' => 'Terima kasih atas saran atau masukan kamu' . ' ' . $user->name]);
    }
}
