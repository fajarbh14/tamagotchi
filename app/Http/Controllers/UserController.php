<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User as Model;

use Auth;
use DB;
use DataTables;
use Helper;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    public function index()
    {
        return view("admin.users.index");
    }

    public function api(Request $request)
    {
        return DataTables::of(Model::where('role','!=',5)->orderBy("role", "DESC"))
                ->addIndexColumn()
                ->addColumn('role', function($data) {
                    return Helper::roleName($data->role);
                })
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("/user/edit/".$data->id),
                        "delete"    => url("/user/delete/".$data->id),
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function create()
    {
        $data = null;
        return view("admin.users.form",compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'   => "required", 
            'username'  => "required|unique:users",
            'password'   => "required", 
            'role'   => "required", 
            // 'jenis'   => "required", 
        ]);

        if ($validator->fails()) {
            return response()->json(["status_code" => 400, "message" => "Validation error", "errors" => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            $data = Model::create([
    			'nama'  => $request['nama'], 
    			'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'role' => $request['role'],
    		]);

    		DB::commit();
            return response()->json(["status_code" => 200, "message" => "Successfully Created Data", "data" => $data]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    
    }
    public function edit($id)
    {
        $data   = Model::findOrFail($id);
        return view("admin.users.form", compact("data"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'   => "required", 
            'role'   => "required", 
        ]);

        if ($validator->fails()) {
            return response()->json(["status_code" => 400, "message" => "Validation error", "errors" => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            $data       = Model::findOrFail($id);
            $dataOld    = Model::findOrFail($id);

            $data ->update([
    			'nama'  => $request['nama'], 
    			'username' => $request['username'],
                'password' => $request['password'] == null ? $data->password : bcrypt($request['password']),
                'role' => $request['role'],
    		]);

    		DB::commit();
    
            return response()->json(["status_code" => 200, "message" => "Successfully Updated Data", "data" => $data]);
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
                return response()->json(["status_code" => 500, "message" => "Tidak Bisa Menghapus Data Diri !", "data" => null]);
            }
            $data->delete();

            DB::commit();
            return response()->json(["status_code" => 200, "message" => "Successfully Deleted Data", "data" => $data]);
        }
        catch (Exception $e) 
        {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }
}
