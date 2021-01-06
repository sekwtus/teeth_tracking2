<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order_sale;
use App\order_teeth;
use App\order_screen;
use DB;
use Gate;

class order4_controller extends Controller
{
    public function index()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin')) {
            abort(404, 'Page NotFound');
        }

        $type_of_product = order_teeth::select_product();
        $type_of_work = order_teeth::select_work();
        $teeth = order_teeth::select_teeth();
        $id_sale = order_sale::select_id_sale();
        $id_screen = order_screen::select_id_screen();

        return view('order.order4', compact('type_of_product', 'type_of_work', 'id_sale', 'teeth', 'id_screen'));
    }

    public function addteeth(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin')) {
            abort(404, 'Page NotFound');
        }

        $validate = \Validator::make($request->all(), [
            'TypeOfWorkID' => 'required',
            'TypeOfProductID' => 'required',
        ], [
            'TypeOfWorkID.required' => 'เลือก Type of work',
            'TypeOfProductID.required' => 'เลือก Type of product',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        // if (($request->TypeOfWorkID != null) && ($request->TypeOfProductID != null)) {
        if ($request->chkTooth_11 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_11', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_11', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_12 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_12', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_12', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_13 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_13', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_13', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_14 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_14', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_14', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_15 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_15', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_15', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_16 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_16', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_16', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_17 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_17', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_17', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_18 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_18', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_18', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_19 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_19', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_19', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_20 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_20', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_20', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_21 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_21', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_21', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_22 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_22', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_22', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_23 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_23', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_23', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_24 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_24', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_24', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_25 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_25', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_25', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_26 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_26', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_26', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_27 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_27', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_27', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_28 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_28', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_28', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_29 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_29', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_29', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_30 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_30', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_30', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_31 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_31', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_31', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_32 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_32', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_32', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_33 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_33', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_33', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_34 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_34', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_34', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_35 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_35', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_35', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_36 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_36', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_36', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_37 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_37', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_37', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_38 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_38', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_38', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_39 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_39', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_39', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_40 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_40', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_40', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_41 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_41', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_41', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_42 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_42', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_42', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_43 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_43', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_43', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_44 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_44', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_44', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_45 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_45', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_45', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_46 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_46', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_46', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_47 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_47', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_47', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_48 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_48', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_48', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        // } else {
        //     return redirect('/order4')->with('alert', 'Deleted!');
        // }

        //show order step 4
        return redirect('/order4');
    }

    public function delete_order4(Request $request, $id)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin')) {
            abort(404, 'Page NotFound');
        }

        order_teeth::delete_teeth($id);

        return redirect('/order4');
    }
}
