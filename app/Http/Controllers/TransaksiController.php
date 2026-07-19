<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
class TransaksiController extends Controller
{
    public function index(){
        $produk = Produk::where('stok','>',0)->get();

        return view('transaksi.index', compact('produk'));

    }

    public function store(Request $request){
        dd($request->all());
    }
}
