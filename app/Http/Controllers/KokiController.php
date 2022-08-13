<?php

namespace App\Http\Controllers;

use App\Models\Order AS Model;
use Illuminate\Http\Request;

use Auth;
use DB;
class KokiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Koki');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Model::with('orders', 'orders.menu')->get();
        return view("admin.koki.index", compact('data'));
    }

    public function toggle($id){
        $data = Model::findOrFail($id);
        $status = "Diproses";
        if($data->status === "Diproses")
            $status = "Selesai Dibuat";
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
