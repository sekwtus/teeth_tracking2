<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\screen;
use DB;
use Gate;
class screen2_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('screen/screen2');
       }

    public function savedata(Request $request) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        DB::update("UPDATE screen SET hook_type = '$request->hook_type',
                                      undercut_hook = '$request->undercut_hook',
                                      bit_undercut_hook = '$request->bit_undercut_hook'
                                      ORDER BY id DESC LIMIT 1", []);

        return redirect('/screen3');
       }
}
