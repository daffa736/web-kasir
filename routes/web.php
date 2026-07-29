<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;
use App\Models\Transaksi;

Route::get('/', function () {
    return view('welcome');
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/simpan', [TransaksiController::class, 'store']);
    Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk']);
    Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat']);
   
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::resource('produk', ProdukController::class);
     
});

require __DIR__.'/auth.php';
  