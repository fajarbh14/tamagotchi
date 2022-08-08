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
}