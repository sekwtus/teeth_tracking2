<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class lab_master_controller extends Controller
{
    public function index()
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('master.lab');
    }

    public function ajaxLab(){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $lab = DB::select("SELECT * from lab_master");
        return Datatables::of($lab)->make(true);
    }
    

    public function add_lab(Request $request){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        DB::insert("INSERT INTO lab_master (lab_name) VALUES ('$request->lab_name')" ,[]);
        return redirect('lab_master');
    }

    public function delete_lab(Request $request){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        DB::delete("DELETE FROM lab_master WHERE id = '$request->id'", []);
        return 'ลบสำเร็จ';
    }

    public function update_lab(Request $request){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        DB::update("UPDATE lab_master set lab_name = '$request->lab_name'  WHERE id = $request->id", []);
        return redirect('lab_master');
    }

}
