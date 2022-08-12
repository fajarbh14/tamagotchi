<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table    = "pegawai";
    protected $fillable = [
        'nama',
        'user_id',
        'alamat',
        'telp'
    ];
}