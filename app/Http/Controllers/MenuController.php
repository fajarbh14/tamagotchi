<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu as Model;

use Auth;
use DB;
use DataTables;
use Helper;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Koki');
    }

    public function index()
    {
        return view("admin.menu.index");
    }

    public function api(Request $request)
    {
        return DataTables::of(Model::orderBy("nama", "DESC"))
                ->addIndexColumn()
                ->addColumn('harga',function($data){
                    return "Rp. ".number_format($data->harga,0,',','.');
                })
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("/menu-makanan/edit/".$data->id),
                        "delete"    => url("/menu-makanan/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function create()
    {
        $data = null;
        return view("admin.menu.form",compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'   => "required", 
            'jenis_menu'   => "required", 
            'harga'   => "required",
            'stok'   => "required", 
        ]);

        if ($validator->fails()) {
            return response()->json(["status_code" => 400, "message" => "Validation error", "errors" => $validator->errors()]);
        }

        DB::beginTransaction();
        try {

            if ($request->file('image') != null) {
                $image  = $request->file('image')->store("foto_menu");
            }

            $data = Model::create([
    			'nama'  => $request['nama'], 
    			'jenis_menu' => $request['jenis_menu'],
                'harga' => str_replace('.','',$request['harga']),
                'stok' => $request['stok'],
                'image' => $image
    		]);

    		DB::commit();
            return response()->json(["status_code" => 200, "message" => "Berhasil Menambahkan Data", "data" => $data]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    
    }
    public function edit($id)
    {
        $data   = Model::findOrFail($id);
        return view("admin.menu.form", compact("data"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'   => "required", 
            'jenis_menu'   => "required", 
            'harga'   => "required",
            'stok'   => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status_code" => 400, "message" => "Validation error", "errors" => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            $data = Model::findOrFail($id);
            
            if ($request->file('image') != null) {
                $image  = $request->file('image')->store("foto_menu");
            }else{
                $image  = $data->image;
            }

            $data ->update([
    			'nama'  => $request['nama'], 
    			'jenis_menu' => $request['jenis_menu'],
                'harga' => str_replace(".", "", $request['harga']),
                'stok' => $request['stok'],
                'image' => $image

    		]);

    		DB::commit();
    
            return response()->json(["status_code" => 200, "message" => "Berhasil Merubah Data", "data" => $data]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try 
        {
            $data = Model::findOrFail($id);
            if(Auth::user()->id == $data->id) {
                return response()->json(["status_code" => 500, "message" => "Tidak Bisa Menghapus Data !", "data" => null]);
            }
            $data->delete();

            DB::commit();
            return response()->json(["status_code" => 200, "message" => "Berhasil Menghapus Data", "data" => $data]);
        }
        catch (Exception $e) 
        {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }
}
