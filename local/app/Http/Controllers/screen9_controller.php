<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
class screen9_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('screen/screen9');
       }
}
