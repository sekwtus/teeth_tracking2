<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gate;
class screen6_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('screen/screen6');
       }

    public function savedata(Request $request) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        DB::update("UPDATE screen SET pontic_design = '$request->pontic_design'
                                      ORDER BY id DESC LIMIT 1", []);

        return redirect('/screen7');
       }
}
