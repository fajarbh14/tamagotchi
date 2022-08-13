<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order as Model;
use App\Models\OrderDetail;
use Auth;
use DB;
use DataTables;
use Helper;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Kasir');
    }

    public function index()
    {
        return view("admin.transaction.index");
    }

    public function api(Request $request)
    {
        return DataTables::of(Model::where('status','!=','Selesai')
            ->where('pelanggan_id','!=', null)
            ->orderBy("id", "DESC"))
                ->addIndexColumn()
                ->addColumn('customer', function($data){
                    return $data->customer->no_meja;
                })
                ->addColumn('action', function($data) {
                    return view("components.transaction.action", [
                        "pembayaran" => url("/transaksi/pembayaran/".$data->id),
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function payment($id)
    {
        $data   = Model::findOrFail($id);
        $dataDetail = OrderDetail::where('pesanan_id', $id)->get();
        return view("admin.transaction.detail", compact("data", "dataDetail"));
    }

    public function update($id)
    {
        DB::beginTransaction();
        try {
            $data = Model::findOrFail($id); 
            $update = $data->update([
                'status' => 'Selesai',
    		]);
    		DB::commit();
            return response()->json(["status_code" => 200, "message" => "Successfully Updated Data", "data" => $data]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }
}
