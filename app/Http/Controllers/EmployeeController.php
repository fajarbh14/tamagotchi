<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee as Model;
use App\Models\User;
use Auth;
use DB;
use DataTables;
use Helper;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    public function index()
    {
        return view("admin.employee.index");
    }

    public function api(Request $request)
    {
        return DataTables::of(Model::orderBy("nama", "DESC"))
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("/pegawai/edit/".$data->id),
                        "delete"    => url("/pegawai/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function create()
    {
        $data = null;
        $users = User::where("role",'!=','1')->Where("role",'!=','5')->get();
        return view("admin.employee.form",compact('data','users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'   => "required", 
            'alamat'   => "required", 
            'telp'   => "required",
            
        ]);

        if ($validator->fails()) {
            return response()->json(["status_code" => 400, "message" => "Validation error", "errors" => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            $data = Model::create([
                'user_id' => $request['user_id'],
    			'nama'  => $request['nama'],
    			'alamat' => $request['alamat'],
                'telp' => $request['telp'],
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
        $users = User::where("role",'!=','1')->where("role",'!=','5')->get();
        return view("admin.employee.form", compact("data","users"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'   => "required", 
            'alamat'   => "required", 
            'telp'   => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status_code" => 400, "message" => "Validation error", "errors" => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            $data = Model::findOrFail($id);
            $data ->update([
                'user_id' => $request['user_id'],
    			'nama'  => $request['nama'],
    			'alamat' => $request['alamat'],
                'telp' => $request['telp'],

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
