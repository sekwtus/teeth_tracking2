<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gate;
class screen5_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('screen/screen5');
       }

    public function savedata(Request $request) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        DB::update("UPDATE screen SET occlusal_staining = '$request->occlusal_staining'
                                      ORDER BY id DESC LIMIT 1", []);

        return redirect('/screen6');
       }
}
