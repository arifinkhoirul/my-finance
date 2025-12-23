<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InputDataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/financial-dashboard', [DashboardController::class, 'index'])->name('financial.dashboard')->middleware(['auth','verified']);


Route::get('/pemasukan', [InputDataController::class, 'createPemasukan'])->name('pemasukan.create');
Route::post('/pemasukan-store', [InputDataController::class, 'storePemasukan'])->name('pemasukan.store');


Route::get('/investasi', [InputDataController::class, 'createInvestasi'])->name('investasi.create');
Route::post('/investasi-store', [InputDataController::class, 'storeInvestasi'])->name('investasi.store');


Route::get('/self-reward', [InputDataController::class, 'createSelfReward'])->name('self.reward.create');
Route::post('/self-reward/store', [InputDataController::class, 'storeSelfReward'])->name('self.reward.store');

Route::get('/pengeluaran', [InputDataController::class, 'createPengeluaran'])->name('pengeluaran.create');
Route::get('/pengeluaran-store', [InputDataController::class, 'storePengeluaran'])->name('pengeluaran.store');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
