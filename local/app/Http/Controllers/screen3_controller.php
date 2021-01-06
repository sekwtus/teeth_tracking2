<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gate;
class screen3_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('screen/screen3');
       }

    public function savedata(Request $request) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        DB::update("UPDATE screen SET contour_type = '$request->contour_type',
                                      contour_non_precious = '$request->contour_non_precious',
                                      undercut_contour = '$request->undercut_contour'
                                      ORDER BY id DESC LIMIT 1", []);

        return redirect('/screen4');
       }
}
