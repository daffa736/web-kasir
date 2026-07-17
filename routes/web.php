<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Produk;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalProduk = Produk::count();

    $stokMenipis = Produk::where('stok', '<', 5)->count();

    return view('dashboard',compact('totalProduk','stokMenipis'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('produk', ProdukController::class);
});

require __DIR__.'/auth.php';
