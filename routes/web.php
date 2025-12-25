<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceProfileController;
use App\Http\Controllers\HandleInvestasicontroller;
use App\Http\Controllers\HandlePemasukanController;
use App\Http\Controllers\HandlePengeluaranController;
use App\Http\Controllers\HandleSelfRewardController;
use App\Http\Controllers\InputDataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistikController;
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



Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/financial-dashboard', [DashboardController::class, 'index'])->name('financial.dashboard');


    Route::get('/pemasukan', [InputDataController::class, 'createPemasukan'])->name('pemasukan.create');
    Route::post('/pemasukan-store', [InputDataController::class, 'storePemasukan'])->name('pemasukan.store');

    Route::get('/pemasukan/all', [HandlePemasukanController::class, 'allPemeasukan'])->name('pemasukan.all');
    Route::delete('/pemasukan/destroy/{id}', [HandlePemasukanController::class, 'deletePemasukan'])->name('pemasukan.delete');




    Route::get('/investasi', [InputDataController::class, 'createInvestasi'])->name('investasi.create');
    Route::post('/investasi-store', [InputDataController::class, 'storeInvestasi'])->name('investasi.store');

    Route::get('/investasi/all', [HandleInvestasicontroller::class, 'allInvestasi'])->name('investasi.all');
    Route::delete('/investasi/destroy/{id}', [HandleInvestasicontroller::class, 'deleteInvestasi'])->name('investasi.delete');


    Route::get('/self-reward', [InputDataController::class, 'createSelfReward'])->name('self.reward.create');
    Route::post('/self-reward/store', [InputDataController::class, 'storeSelfReward'])->name('self.reward.store');

    Route::get('/self-reward/all', [HandleSelfRewardController::class, 'allSelfReward'])->name('self.reward.all');
    Route::delete('/self-reward/destroy/{id}', [HandleSelfRewardController::class, 'deleteSelfReward'])->name('self.reward.delete');


    Route::get('/pengeluaran', [InputDataController::class, 'createPengeluaran'])->name('pengeluaran.create');
    Route::post('/pengeluaran-store', [InputDataController::class, 'storePengeluaran'])->name('pengeluaran.store');

    Route::get('/pengeluaran/all', [HandlePengeluaranController::class, 'allpengeluaran'])->name('pengeluaran.all');
    Route::delete('/pengeluaran/destroy/{id}', [HandlePengeluaranController::class, 'deletePengeluaran'])->name('pengeluaran.delete');


    Route::get('/statistik', [StatistikController::class, 'indexStatistik'])->name('statistik.index');

    Route::get('/myfinance/profile', [FinanceProfileController::class, 'myProfile'])->name('myProfile.index');

});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
