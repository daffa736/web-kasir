<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['kode_transaksi','total_harga','bayar','kembalian'];
}
