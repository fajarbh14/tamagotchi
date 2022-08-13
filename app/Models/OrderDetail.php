<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table    = "pesanan_detail";
    protected $fillable = [
        'pesanan_id',
        'menu_id',
        'jumlah',
        'subtotal'
    ];

    function order(){
        return $this->belongsTo(Order::class, 'pesanan_id');
    }
    function menu(){
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
