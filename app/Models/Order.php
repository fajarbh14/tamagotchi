<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table    = "pesanan";
    protected $fillable = [
        'no_transaksi',
        'user_id',
        'pelanggan_id',
        'total_bayar',
        'status'
    ];

    function customer()
    {
        return $this->belongsTo( Pelanggan::class, 'pelanggan_id');
    }
}
