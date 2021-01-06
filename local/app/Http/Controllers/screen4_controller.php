<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gate;
class screen4_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('screen/screen4');
       }

    public function savedata(Request $request) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        DB::update("UPDATE screen SET shade_one = '$request->shade_one',
                                      key_shade_one = '$request->key_shade_one',
                                      shade_many1 = '$request->shade_many1',
                                      shade_many2 = '$request->shade_many2',
                                      shade_many3 = '$request->shade_many3',
                                      color1 = '$request->color1',
                                      color2 = '$request->color2',
                                      color3 = '$request->color3'
                                      ORDER BY id DESC LIMIT 1", []);

        return redirect('/screen5');
       }
}
