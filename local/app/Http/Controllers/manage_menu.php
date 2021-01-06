<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\order;
use App\order_teeth;
use DB;
use App\menu;
use Auth;
use Gate;
class manage_menu extends Controller
{

    public function index()
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $data_menu = menu::all();

        return view('menu_setting.add_menu',compact('data_menu'));
    }

    public function addMenu(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        if($request->parent_menu != ""){

            $data_menu_code = menu::where('menu_code',$request->parent_menu)->orderBy('menu_code', 'desc')->limit(1)->first();

            $data_menu_code2 = menu::where('menu_parent',$request->parent_menu)->orderBy('menu_code', 'desc')->limit(1)->first();


            if($data_menu_code2!= 0)
            {
                $value = $data_menu_code2->menu_code;
                $value = $value+1;

                DB::insert("INSERT INTO menu (menu_parent,
                                        menu_code,
                                        menu_name,
                                        menu_datapath,
                                        menu_icon,
                                        menu_status,
                                        created_by,
                                        modified_by)
                values ('$request->parent_menu',
                        '$value',
                        '$request->menuname',
                        '$request->path',
                        '$request->icon',
                        'A',
                        1,
                        1)", []);
            }
            else
            {
                $value = $data_menu_code->menu_code;
                $value = $value+1;
                DB::insert("INSERT INTO menu (menu_parent,
                                        menu_code,
                                        menu_name,
                                        menu_datapath,
                                        menu_icon,
                                        menu_status,
                                        created_by,
                                        modified_by)
                                values ('$request->parent_menu',
                                        '$value',
                                        '$request->menuname',
                                        '$request->path',
                                        '$request->icon',
                                        'A',
                                        1,
                                        1)", []);
            }
        }

        else if($request->menu_parent == ""){
            // $data_menu_code = DB::select("SELECT
            // Max(menu.menu_code)
            // FROM
            // menu
            // WHERE
            // menu.menu_parent = '' ", []);

            $data_menu_code = menu::where('menu_parent',0)->orderBy('menu_code', 'desc')->limit(1)->first();

            $value = $data_menu_code->menu_code;
            $value = $value+100;
            // $value = $data_menu_code->menu_code;
            // $value = 700;
            DB::insert("INSERT INTO menu (menu_parent,
                                        menu_code,
                                        menu_name,
                                        menu_datapath,
                                        menu_icon,
                                        menu_status,
                                        created_by,
                                        modified_by)
                                values ('$request->parent_menu',
                                        '$value',
                                        '$request->menuname',
                                        '$request->path',
                                        '$request->icon',
                                        'A',
                                        1,
                                        1)", []);
        }

        //[{"menu_id":13,"menu_parent":600,"menu_code":606,"menu_name":"Factory","menu_datapath":"factory","menu_icon":"","menu_status":"A","created_by":1,"created_at":"2018-12-17 17:42:55","modified_by":1,"updated_at":"2018-12-17 17:42:55"}];


        return redirect('/add_menu');
    }

    public function request_menu_code(Request $request)
    {


    }
}
