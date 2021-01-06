<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\type_users;
use App\menu;
use App\user_group_permission;
use Gate;
use DB;

class group_setting extends Controller
{
    public function index(){
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }// use in first function

        $data_type_name = type_users::select_all();
        $data_menu = menu::all();
        $data_permission = user_group_permission::select_all();

        return view('menu_setting.group_setting',compact('data_type_name','data_menu','data_permission'));
    }

    public function addTypeUsers(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }


        // $data_menu_code = menu::where('menu_parent',0)->orderBy('menu_code', 'desc')->limit(1)->first();

        $Name = $request->typeName;
        $noneActive = '0';
        type_users::insert($Name); // บันทึกtype ใหม่
        // $id_type = type_users::select_by_name($Name); //query เพื่อเอาid type ล่าสุด

        // $id_type = job_main::where('Name', $Name)->limit(1)->first();
        $id_type = DB::table('type_users')->where('Name', $Name)->first();

        // return $id_type->ID;
        // do {
        //     $id_type = type_users::select_by_name($Name); //query เพื่อเอาid type ล่าสุด
        //     foreach ($id_type as $type_name) {
        //         $type_names = $type_name->Name;
        //     }
        // } while ($type_names != $Name);

        // $menu_name = DB::table('menu')->where('menu_code', '0');

        $menu_name = DB::table('menu')->get();

        foreach ($menu_name as $menu_names) {
            if (($menu_names->menu_code % 100) == 0) {
                $menu = $menu_names->menu_name;
                user_group_permission::insert($menu,$id_type->ID,$noneActive);
            }
        }
        // return $menu;


        // $menu_name = menu::select_name();
        //     // return $menu_name;
        // foreach ($menu_name as $name) {
        //     user_group_permission::insert($name->manu_name,$id_type->ID,$noneActive);

        // }

        return redirect('/group_setting');
    }

    public function permission_group(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        $active = '1';
        $noneActive = '0';
        // return $request->name[1];
        // $menu = menu::select_name();
        user_group_permission::update0($request->id_type_name,$noneActive);

            for ( $count = 0 ; $count < sizeof($request->name) ; $count++) {
                user_group_permission::update1( $request->name[$count],$request->id_type_name,$active);
            }

        return redirect('/group_setting');
    }

}
