<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
class ProdukController extends Controller
{
    public function index(){
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function create(){
        //
    }
    public function store(Request $request){
         $request->validate([
            'produk' => 'required|regex:/^[a-zA-Z\s]+$/|max:200',
            'harga' => 'required|integer',
            'stok' => 'required|integer'
        ]);

        Produk::create($request->all());

        return redirect()->back();
    }

    public function destroy($id){
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect()->route('produk.index');
}

    public function edit($id){
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'produk' => 'required|string|max:200',
            'harga' => 'required|integer|',
            'stok' => 'required|integer|'
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update($request->all());

        return redirect()->route('produk.index');


    }

    public function show(){
        //
    }
}