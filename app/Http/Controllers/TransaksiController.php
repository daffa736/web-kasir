<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(){
        $produk = Produk::where('stok','>',0)->get();

        return view('transaksi.index', compact('produk'));

    }

    public function store(Request $request){
        $request->validate([ //validasi array
            'items' => 'required|array',
            'total' => 'required|numeric',
            'bayar' => 'required|numeric',
            'kembali' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try{

        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX' . date('YmdHis'),
            'total_harga' => $request->total,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembali
        ]);

        foreach($request->items as $item){
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $item['id'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal']
            ]);
        }

        $produk = Produk::findOrFail($item['id']);
         if($produk->stok < $item['qty']){
            throw new \Exception("stok produk '{$produk->produk}' tidak cukup");
         }
         $produk->stok -= $item['qty'];
         $produk->save();
       

        DB::commit();

        return response()->json([
            'success' => true,
            'massage' => 'data berhasil',
              'transaksi_id' => $transaksi->id
            
        ]);

         }catch (\Exception $e){
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'gagal menyimpan' . $e->getMessage(),
              
            ], 500);
         }
    }

    public function struk($id){
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);

        return view('transaksi.struk', compact('transaksi'));
    }
}