<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use App\Models\Siswa;
class Helper
{

    public static function roleName($roleId) {
        
        $result = "";
        if($roleId == 1) {
            $result = "Admin";
        }
        else if($roleId == 2) { 
            $result = "Kasir";
        } 
        else if($roleId == 3) {
            $result = "Koki";
        }
        else if($roleId == 4) {
            $result = "Pelayan";
        }
        else if($roleId == 5) {
            $result = "Pelanggan";
        }

        return $result;
    }

    public static function transactionCode()
    {
        $result = "";
        $q = \DB::table('pesanan')
             ->select(\DB::raw('max(RIGHT(no_transaksi, 3)) as no_transaksi'))
             ->get();
        $kd = "";
        if($q->count()>0){
            foreach($q as $k){
                $tmp = ((int)$k->no_transaksi)+1;
                $kd = sprintf("%03d", $tmp);
            }
        }else{
            $kd = "001";
        }

        $result = "TRS-".$kd;

        return $result;
    }
}