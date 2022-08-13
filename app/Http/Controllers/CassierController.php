<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Menu;

use Auth;
use DB;
use DataTables;
use Helper;

class CassierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Kasir');
    }

    public function index()
    {
        return view("admin.order.index");
    }

    public function getMenu()
    {
        $data = Menu::where('stok','>',0)->get();
        return response()->json(["status_code" => 200, "message" => "Berhasil Mendapatkan Menu", "data" => $data]);
    }


    public function order(Request $request)
    {

        DB::beginTransaction();
        try {

            $data = Order::create([
    			'no_transaksi'  => Helper::transactionCode(), 
    			'user_id' => Auth::user()->id,
                'total_bayar' => $request['total_bayar'],
                'status' => 'Selesai',
    		]);

            foreach($request['menu_id'] as $key => $value) {
                OrderDetail::create([
                    'pesanan_id' => $data->id,
                    'menu_id' => $value,
                    'jumlah' => $request['jumlah'][$key],
                    'subtotal' => $request['subtotal'][$key],
                ]);
                $menu = Menu::find($value);
                $menu->stok = $menu->stok - $request['jumlah'][$key];
                $menu->save();
            }

    		DB::commit();
            return response()->json(["status_code" => 200, "message" => "Berhasil Menambahkan Data", "data" => $data]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    
    }
}
