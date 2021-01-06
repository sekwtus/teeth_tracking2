<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\zone;
use DataTables;
use Gate;
use App\Http\Controllers\Controller;

class zone_master_controller extends Controller
{
    public function index()
    {
        $data_zone = zone::all();

        return view('master.zone_master', compact('data_zone'));
    }

    public function getZone()
    {
        return view('master.zone');
    }
    public function ajaxGetZone()
    {
        $data_zone = zone::all();
        return Datatables::of($data_zone)->make(true);
    }

    public function add_zone(Request $request)
    {
        DB::insert("INSERT INTO `zone` (`Name`) VALUES ('$request->zone_name')" ,[]);
        return redirect('zone');
    }
    public function delete_zone(Request $request)
    {
        
        DB::delete("DELETE FROM `zone` WHERE ID = '$request->ID'", []);
        return 'ลบสำเร็จ';
    }
    public function update_zone(Request $request)
    {
        DB::update("UPDATE `zone` set `Name` = '$request->Name'WHERE ID = $request->ID", []);
        return redirect('zone');
    }
    
    
 

    public function selectArea( $id)
    {
        $data_area = DB::select("SELECT
                                        area.ID,
                                        area.`Name`,
                                        area.ZoneID
                                        FROM
                                        area
                                        WHERE
                                        area.ZoneID = '$id'
                                        "); 

        $data_company = DB::select("SELECT
                                        zone.ID,
                                        zone.`Name`
                                        FROM
                                        zone
                                        WHERE
                                        zone.ID  = '$id'
                                            ");
        //return $data_area;
        //return $data_company;
       return view('master.zone_master2', compact('data_area', 'data_company'));
    }

}
