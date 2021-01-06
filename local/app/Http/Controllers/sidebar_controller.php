<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class sidebar_controller extends Controller
{
    public function index() {

            $data_all = DB::select("SELECT
                                    *
                                    FROM
                                    Employee", []);

            view()->share('data_all');
       }
}
