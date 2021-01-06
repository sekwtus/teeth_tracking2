<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\screen;
use DB;
use Gate;

class screen_controller extends Controller
{
    public function getIndex()
    {
        if (!Gate::allows('IsAdmin')) {
            abort(404, 'Page NotFound');
        }

        return view('screen/screen1');
    }

    public function getIndex1()
    {
        $id_screen = DB::select('SELECT
                                screen.ID
                                FROM
                                screen
                                ORDER BY id DESC LIMIT 1', []);

        $data_Requirement = DB::select('SELECT
                                    type_Requirement.ID,
                                    type_Requirement.`Name`
                                    FROM
                                    type_Requirement', []);

        return view('screen/screen1_1', compact('data_Requirement', 'id_screen'));
    }

    public function savedata(Request $request)
    {
        if (!Gate::allows('IsAdmin')) {
            abort(404, 'Page NotFound');
        }

        $data_screen = new screen();
        $data_screen->Metal_type = $request->Metal_type;
        $data_screen->save();

        return redirect('/screen2');
    }

    public function continuouswork(Request $request, $id)
    {
        DB::update("UPDATE job SET job_current_department ='994' where  ID_order_screen = ?  ", [$id]);
        DB::update("UPDATE order_screen SET StartDate = '$request->StartDate',DeliverDate = '$request->DeliverDate'  where  ID = ?  ", [$id]);

        return redirect('/mainorder');
    }
}
