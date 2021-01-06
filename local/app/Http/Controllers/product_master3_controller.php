<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Gate;
use DB;

class product_master3_controller extends Controller
{
    public function getIndex()
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $data_product = DB::select("SELECT type_of_product.ID, type_of_product.`Name` FROM type_of_product", []);
        $data_department = DB::select("SELECT department.ID,department.`Name`,department.DivisionID FROM department", []);

        return view('master.product_master3',compact('data_product','data_department'));
    }

    public function Index()
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $data_product = DB::select("SELECT type_of_product.ID, type_of_product.`Name` FROM type_of_product", []);
        $data_department = DB::select("SELECT department.ID,department.`Name`,department.DivisionID FROM department", []);
        $data_sub_department = DB::select("SELECT sub_department.ID, sub_department.DepartmentID, sub_department.`Name` FROM sub_department", []);

        return view('master.product_master3',compact('data_product','data_department','data_sub_department'));
    }




    public function store(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $validate = \Validator::make($request->all(), [
            'Name'  =>  'required',
        ], [
            'Name.required'  =>  'ชื่อลูกค้าต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->Name;
        $CustomerTypeID = $request->CustomerTypeID;
        $AreaID = $request->AreaID;
        customer::insert($Name,$CustomerTypeID,$AreaID);

        return redirect('customer');
    }


    public function update(Request $request, $id)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $validate = \Validator::make($request->all(), [
            'Name'  =>  'required',
        ], [
            'Name.required'  =>  'ชื่อลูกค้าต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->Name;
        $CustomerTypeID = $request->CustomerTypeID;
        $AreaID = $request->AreaID;
        customer::update_by_id($id,$Name,$CustomerTypeID,$AreaID);

        return redirect('customer');
    }

    public function destroy($id)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        customer::delete_by_id($id);

        return redirect('customer');
    }
}
