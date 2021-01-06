<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order_sale;
use App\order_teeth;
use App\order_screen;
use App\type_of_group;
use Auth;
use DB;
use Gate;

class select_teeth_controller extends Controller
{
    public function teeth($id)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $type_of_product = order_teeth::select_product();
        $type_of_work = order_teeth::select_work();
        $teeth = order_teeth::screen_teeth($id);

        return view('screen.select_teeth.teeth1', compact('type_of_product', 'type_of_work', 'teeth', 'id'));
    }

    public function groupteeth($id)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        // $id_sale = order_sale::select_id_sale();
        // $id_screen = order_screen::select_id_screen();
        $type_of_group = type_of_group::select_type_group();
        $teeth = order_teeth::screen_teeth_group($id);
        $group_no = order_teeth::select_group();

        return view('screen.select_teeth.teeth2', compact('type_of_group', 'teeth', 'group_no', 'id'));
        // return $teeth;
    }

    // public function detailteeth($id)
    // {
    //     if(!Gate::allows('IsScrene')){
    //         if(!Gate::allows('IsAdmin')){
    //             abort(404,"Page NotFound");
    //         }
    //     }
    //     $data_all = order_screen::select_customer($id);
    //     $teeth = order_teeth::screen_teeth_group($id);

    //     return view('screen.select_teeth.teeth3',compact('teeth','id','data_all'));

    // }

    public function detailteeth($id)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $data_all = order_screen::select_customer($id);
        $teeth = order_teeth::screen_teeth_group($id);

        // $data_order_attachment = DB::select('SELECT
        //             order_attachment_screen.AttachmentID,attachment.Name
        //             FROM
        //             order_attachment_screen
        //             INNER JOIN attachment
        //             ON order_attachment_screen.AttachmentID=attachment.ID
        //             WHERE order_attachment_screen.ScreenID = ?', [$id]);

        return view('screen.select_teeth.teeth3', compact('teeth', 'id', 'data_all'));
    }

    public function Enclosed($id_screen)
    {
        $data_attachment = DB::select("SELECT
                    attachment.ID,
                    attachment.`Name`,
                    attachment.AttachmentTypeID
                    FROM
                    attachment ,
                    attachment_type
                    WHERE
                    attachment.AttachmentTypeID = '1' AND attachment.AttachmentTypeID = attachment_type.ID", []);
        // $data_order_attachment = order_attachment::select_order_attachment();
        $data_order_attachment = DB::select('SELECT
                    order_attachment.AttachmentID,attachment.Name
                    FROM
                    order_attachment
                    INNER JOIN attachment
                    ON order_attachment.AttachmentID=attachment.ID
                    WHERE order_attachment.OrderID = (SELECT order_sale.ID
                    FROM order_sale
                    WHERE order_sale.SaleID = ?
                    ORDER BY id DESC LIMIT 1)', [Auth::user()->id]);

        return redirect('/mainscreen/teeth/detail/'.$id_screen);
        // return view('order/order6', compact('data_attachment', 'data_order_attachment', 'id_screen'));
    }

    public function addteeth(Request $request)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
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
        return redirect('/mainscreen/teeth/'.$request->id_screen);
    }

    public function delete_teeth($id, $id_screen, $TeethID)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }
        order_teeth::delete_teeth($id, $id_screen, $TeethID);

        return redirect('/mainscreen/teeth/'.$id_screen);
    }

    public function addgroup(Request $request)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        if ($request->chkTooth_11 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '11'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '11'  ", []);
        }
        if ($request->chkTooth_12 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '12'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '12'  ", []);
        }
        if ($request->chkTooth_13 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '13'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '13'  ", []);
        }
        if ($request->chkTooth_14 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '14'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '14'  ", []);
        }
        if ($request->chkTooth_15 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '15'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '15'  ", []);
        }
        if ($request->chkTooth_16 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '16'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '16'  ", []);
        }
        if ($request->chkTooth_17 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '17'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '17'  ", []);
        }
        if ($request->chkTooth_18 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '18'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '18'  ", []);
        }
        if ($request->chkTooth_19 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '19'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '19'  ", []);
        }
        if ($request->chkTooth_20 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '20'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '20'  ", []);
        }
        if ($request->chkTooth_21 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '21'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '21'  ", []);
        }
        if ($request->chkTooth_22 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '22'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '22'  ", []);
        }
        if ($request->chkTooth_23 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '23'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '23'  ", []);
        }
        if ($request->chkTooth_24 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '24'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '24'  ", []);
        }
        if ($request->chkTooth_25 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '25'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '25'  ", []);
        }
        if ($request->chkTooth_26 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '26'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '26'  ", []);
        }
        if ($request->chkTooth_27 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '27'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '27'  ", []);
        }
        if ($request->chkTooth_28 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '28'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '28'  ", []);
        }
        if ($request->chkTooth_29 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '29'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '29'  ", []);
        }
        if ($request->chkTooth_30 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '30'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '30'  ", []);
        }
        if ($request->chkTooth_31 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '31'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '31'  ", []);
        }
        if ($request->chkTooth_32 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '32'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '32'  ", []);
        }
        if ($request->chkTooth_33 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '33'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '33'  ", []);
        }
        if ($request->chkTooth_34 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '34'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '34'  ", []);
        }
        if ($request->chkTooth_35 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '35'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '35'  ", []);
        }
        if ($request->chkTooth_36 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '36'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '36'  ", []);
        }
        if ($request->chkTooth_37 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '37'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '37'  ", []);
        }
        if ($request->chkTooth_38 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '38'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '38'  ", []);
        }
        if ($request->chkTooth_39 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '39'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '39'  ", []);
        }
        if ($request->chkTooth_40 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '40'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '40'  ", []);
        }
        if ($request->chkTooth_41 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '41'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '41'  ", []);
        }
        if ($request->chkTooth_42 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '42'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '42'  ", []);
        }
        if ($request->chkTooth_43 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '43'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '43'  ", []);
        }
        if ($request->chkTooth_44 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '44'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '44'  ", []);
        }
        if ($request->chkTooth_45 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '45'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '45'  ", []);
        }
        if ($request->chkTooth_46 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '46'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '46'  ", []);
        }
        if ($request->chkTooth_47 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '47'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '47'  ", []);
        }
        if ($request->chkTooth_48 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '48'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '48'  ", []);
        }

        return redirect('/mainscreen/teeth/group/'.$request->id_screen);
    }

    public function delete_group($id, $id_screen)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        order_teeth::update_teeth_group($id, $id_screen);

        return redirect('/mainscreen/teeth/group/'.$id_screen);
    }

    public function save(Request $request, $id)
    {
        DB::update("UPDATE order_screen SET Model = '$request->Model' where  ID = ?  ", [$id]);
        DB::update("UPDATE order_screen SET StartDate = '$request->StartDate',DeliverDate = '$request->DeliverDate',PatientName = '$request->PatientName',
                                             DeliverDate_comment = '$request->other',PatientAge = '$request->PatientAge',PatientHN= '$request->PatientHN' where  ID = ?  ", [$id]);

        return redirect('mainscreen/');
    }
}
