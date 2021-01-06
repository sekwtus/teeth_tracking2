<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use DB;


class main_product_controller extends Controller
{
    public function getIndex()
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $data_department = DB::select("SELECT
        department.ID,
        department.`Name`
        FROM
        department
        where
        DivisionID ='1'
        ", []);
    return view('production.main_product',compact('data_department'));
    }
}
