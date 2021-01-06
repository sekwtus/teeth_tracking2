<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gate;
class screen7_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('screen/screen7');
       }

    public function savedata(Request $request) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        DB::update("UPDATE screen SET mental_design_type_1 = '$request->mental_design_type_1',
                                      mental_design_type_2 = '$request->mental_design_type_2',
                                      mental_design_type_3 = '$request->mental_design_type_3'
                                      ORDER BY id DESC LIMIT 1", []);

        return redirect('/screen8');
       }
}
