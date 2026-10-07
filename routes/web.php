<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use App\Models\Transaksi;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', function () {
    $totalProduk = Produk::count();

    $stokMenipis = Produk::where('stok', '<', 5)->count();

    $transaksiHariIni = Transaksi::whereDate('created_at',now()->today())->count();
    $pendapatanHariIni = Transaksi::whereDate('created_at',now()->today())->sum('total_harga');
    $transaksiTerbaru = Transaksi::whereDate('created_at', now()->today())->latest()->take(5)->get();

    return view('dashboard',compact('totalProduk','stokMenipis','transaksiHariIni','pendapatanHariIni','transaksiTerbaru'));
})->name('dashboard');

    Route::resource('profile', ProfileController::class);
    Route::resource('transaksi', TransaksiController::class);
   
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::resource('produk', ProdukController::class);
     
});

require __DIR__.'/auth.php';
  