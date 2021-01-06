<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class branch_controller extends Controller
{
    public function index()
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        $company = DB::select("SELECT * from company");
        $lab_master = DB::select("SELECT * from lab_master");

        return view('master.branch',compact('lab_master','company'));
    }

    public function ajaxbranch(){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $branch = DB::select("SELECT
                                type_Branch.ID,
                                type_Branch.`Name` as branch_name,
                                company.`Name` as company_name,
                                type_Branch.lab
                                FROM
                                type_Branch
                                LEFT JOIN company ON type_Branch.companyID = company.ID
                                ORDER BY type_Branch.ID");
        return Datatables::of($branch)->make(true);
    }
    

    public function add_branch(Request $request){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        DB::insert("INSERT INTO type_Branch (`Name`,companyID,lab) VALUES ('$request->branch_name','$request->ddlcompany','$request->ddllab')" ,[]);
        return redirect('branch');
    }

    public function delete_branch(Request $request){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        DB::delete("DELETE FROM type_Branch WHERE ID = '$request->id'", []);
        return 'ลบสำเร็จ';
    }

    public function getLab_company(){
        $company = DB::select("SELECT * from company");
        $lab_master = DB::select("SELECT * from lab_master");
        return array($company,$lab_master);

    }

    public function update_branch(Request $request){
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        DB::update("UPDATE type_Branch set `Name` = '$request->branch_name',`companyID` = '$request->ddlcompany'
        ,`lab` = '$request->ddllab'   WHERE ID = $request->ID", []);
        return redirect('branch');
    }

}
