<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\type_of_group;
use DB;
use Auth;
use Gate;
use App\order_teeth;
use App\order_sale;
use App\order_screen;
class order5_controller extends Controller
{
    public function index( )
    {
        if(!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $id_sale = order_sale::select_id_sale();
        $id_screen = order_screen::select_id_screen();
        $type_of_group = type_of_group::select_type_group();
        $teeth = order_teeth::select_teeth_group();
        $group_no = order_teeth::select_group();

        return view('order.order5',compact('type_of_group','id_sale','teeth','group_no','id_screen'));

    }

    public function addgroupteeth(Request $request)
    {
        if(!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        if($request->chkTooth_11 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '11'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '11'  ", []);}
        if($request->chkTooth_12 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '12'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '12'  ", []);}
        if($request->chkTooth_13 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '13'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '13'  ", []);}
        if($request->chkTooth_14 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '14'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '14'  ", []);}
        if($request->chkTooth_15 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '15'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '15'  ", []);}
        if($request->chkTooth_16 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '16'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '16'  ", []);}
        if($request->chkTooth_17 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '17'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '17'  ", []);}
        if($request->chkTooth_18 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '18'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '18'  ", []);}
        if($request->chkTooth_19 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '19'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '19'  ", []);}
        if($request->chkTooth_20 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '20'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '20'  ", []);}
        if($request->chkTooth_21 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '21'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '21'  ", []);}
        if($request->chkTooth_22 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '22'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '22'  ", []);}
        if($request->chkTooth_23 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '23'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '23'  ", []);}
        if($request->chkTooth_24 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '24'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '24'  ", []);}
        if($request->chkTooth_25 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '25'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '25'  ", []);}
        if($request->chkTooth_26 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '26'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '26'  ", []);}
        if($request->chkTooth_27 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '27'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '27'  ", []);}
        if($request->chkTooth_28 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '28'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '28'  ", []);}
        if($request->chkTooth_29 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '29'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '29'  ", []);}
        if($request->chkTooth_30 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '30'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '30'  ", []);}
        if($request->chkTooth_31 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '31'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '31'  ", []);}
        if($request->chkTooth_32 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '32'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '32'  ", []);}
        if($request->chkTooth_33 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '33'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '33'  ", []);}
        if($request->chkTooth_34 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '34'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '34'  ", []);}
        if($request->chkTooth_35 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '35'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '35'  ", []);}
        if($request->chkTooth_36 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '36'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '36'  ", []);}
        if($request->chkTooth_37 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '37'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '37'  ", []);}
        if($request->chkTooth_38 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '38'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '38'  ", []);}
        if($request->chkTooth_39 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '39'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '39'  ", []);}
        if($request->chkTooth_40 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '40'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '40'  ", []);}
        if($request->chkTooth_41 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '41'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '41'  ", []);}
        if($request->chkTooth_42 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '42'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '42'  ", []);}
        if($request->chkTooth_43 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '43'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '43'  ", []);}
        if($request->chkTooth_44 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '44'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '44'  ", []);}
        if($request->chkTooth_45 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '45'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '45'  ", []);}
        if($request->chkTooth_46 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '46'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '46'  ", []);}
        if($request->chkTooth_47 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '47'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '47'  ", []);}
        if($request->chkTooth_48 != null){
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '48'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '48'  ", []);}

        return redirect('/order5');
    }

    public function delete_order5($id){
        if(!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        order_teeth::update_teeth_group($id);

        return redirect('/order5');
    }
}
