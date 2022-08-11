<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = "pelanggan";
    protected $fillable = [
        'no_meja',
        'user_id',
        'status'
    ];
    function user(){
        return $this->belongsTo(User::class, "user_id"); 
    }
}
