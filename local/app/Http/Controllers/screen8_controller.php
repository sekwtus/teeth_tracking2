<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gate;
class screen8_controller extends Controller
{
    public function getIndex( ) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        $id_screen = DB::select("SELECT
                                    screen.ID
                                    FROM
                                    screen
                                    ORDER BY id DESC LIMIT 1", []);

        $data_Requirement = DB::select("SELECT
                                            type_Requirement.ID,
                                            type_Requirement.`Name`
                                            FROM
                                            type_Requirement", []);

        return view('screen/screen8',compact('data_Requirement','id_screen'));
       }

    public function savedata(Request $request) {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        //ดู_Wax_full_contour
        if($request->ดู_Wax_full_contour != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '1'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ดู_Wax_full_contour')", []);}
        if($request->ดู_Wax_full_contour == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '1' ", []);}

        //ดู Contour porcelain
        if($request->ดู_Contour_porcelain != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '2'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ดู_Contour_porcelain')", []);}
        if($request->ดู_Contour_porcelain == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '2' ", []);}

        //ดู Design ทางไลน์
        if($request->ดู_Design_ทางไลน์ != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '3'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ดู_Design_ทางไลน์')", []);}
        if($request->ดู_Design_ทางไลน์ == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '3' ", []);}

        //ลองโครงก่อน
        if($request->ลองโครงก่อน != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '4'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ลองโครงก่อน')", []);}
        if($request->ลองโครงก่อน == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '4' ", []);}

        //ลอง contour พอสเลนก่อนเกรซ
        if($request->ลอง_contour_พอสเลนก่อนเกรซ != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '5'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ลอง_contour_พอสเลนก่อนเกรซ')", []);}
        if($request->ลอง_contour_พอสเลนก่อนเกรซ == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '5' ", []);}

        //ขอ SPURE ด้วย
        if($request->ขอ_SPURE_ด้วย != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '6'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ขอ_SPURE_ด้วย')", []);}
        if($request->ขอ_SPURE_ด้วย == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '6' ", []);}

        //ทำ PINDEX
        if($request->ทำ_PINDEX != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '7'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ทำ_PINDEX')", []);}
        if($request->ทำ_PINDEX == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '7' ", []);}

        //จะส่งคนไข้มาเทียบสีที่ Lab
        if($request->จะส่งคนไข้มาเทียบสีที่_Lab != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '8'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->จะส่งคนไข้มาเทียบสีที่_Lab')", []);}
        if($request->จะส่งคนไข้มาเทียบสีที่_Lab == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '8' ", []);}

        //หมอส่งสีฟันมาทางไลน์
        if($request->หมอส่งสีฟันมาทางไลน์ != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '9'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->หมอส่งสีฟันมาทางไลน์')", []);}
        if($request->หมอส่งสีฟันมาทางไลน์ == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '9' ", []);}

        //ทางไลน์
        if($request->ทางไลน์ != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '10'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ทางไลน์')", []);}
        if($request->ทางไลน์ == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '10' ", []);}

        //ส่งกลับ
        if($request->ส่งกลับ != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '11'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ส่งกลับ')", []);}
        if($request->ส่งกลับ == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '11' ", []);}

        //ให้ช่างโทรกลับในขั้นตอน____________
        if($request->ให้ช่างโทรกลับในขั้นตอน____________ != null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '12'", []);
            DB::insert("INSERT INTO group_req_screen (ID_screen, ID_type_requirement) values ('$request->id_screen','$request->ให้ช่างโทรกลับในขั้นตอน____________')", []);}
        if($request->ให้ช่างโทรกลับในขั้นตอน____________ == null){
            DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '12' ", []);}



        DB::delete("DELETE FROM group_req_screen WHERE ID_screen = '$request->id_screen' AND ID_type_requirement = '0'", []);
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        return redirect('/screen9');
       }
}
