<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan as Model;
use App\Models\User as User;

use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Pelayan');
    }

    public function index()
    {
        return view("admin.pelanggan.index");
    }

    public function api(){
        return DataTables::of(Model::with('user')->get())
        ->addIndexColumn()
        ->addColumn('user', function($data){
            return $data->user->nama;
        })
        ->addColumn('action', function($data) {
            return view("components.action", [
                "edit"      => url("/pelanggan/".$data->id."/edit"),
                "delete"    => url("/pelanggan/delete/".$data->id),
            ]);
        })
        ->rawColumns(['action'])
        ->make(true);
    }

 
    public function create()
    {
        $data = null;
        $users = User::where("role", "5")->get();
        return view("admin.pelanggan.form",compact('data', 'users'));
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'user_id' => "required|unique:pelanggan",
            'no_meja' => "required|unique:pelanggan",
            'status' => "required",
        ]);
        
        DB::beginTransaction();
        try {
            $data = Model::create($input);
            DB::commit();
            return response()->json(["status_code" => 200, "message" => "Successfully Created Data", "data" => $data]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }

    public function toggle($id){
        $data = Model::findOrFail($id);
        $status = "Kosong";
        if($data->status === "Kosong")
            $status = 'Dipakai';
        DB::beginTransaction();
        try {
            $data->status = $status;
            $data->save();
            DB::commit();
            return response()->json(["status_code" => 200, "message" => "Successfully Updated Data", "data" => $status]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data = Model::findOrFail($id);
        $users = User::where("role", "5")->get();
        return view("admin.pelanggan.form", compact("data", "users"));
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'user_id' => "required",
            'no_meja' => "required",
            'status' => "required",
        ]);

        DB::beginTransaction();
        try {

            $data = Model::findOrFail($id);
            $data ->update($input);
            DB::commit();
            return response()->json(["status_code" => 200, "message" => "Successfully Updated Data", "data" => $data]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["status_code" => 500, "message" => $e->getMessage(), "data" => null]);
        }
    }

    public function destroy($id)
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
