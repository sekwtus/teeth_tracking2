<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\attachment;
use App\order_attachment;
use App\order_teeth;
use DB;
use App\order_sale;
use App\order_screen;
use Gate;
use Auth;

class order6_controller extends Controller
{
    public function index1()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        // $id_order = order_sale::select_id_sale();
        $id_order = DB::select("SELECT
                                    order_sale.ID
                                    FROM
                                    order_sale
                                    WHERE order_sale.SaleID = ?
                                    ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // $id_screen = order_screen::select_id_screen();
        $id_screen = DB::select("SELECT
                                    order_screen.ID
                                    FROM
                                    order_screen
                                    WHERE order_screen.SaleID = ?
                                    ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // $data_attachment = attachment::select_attachment();
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
        $data_order_attachment = DB::select("SELECT
                                    order_attachment.AttachmentID,attachment.Name
                                    FROM
                                    order_attachment
                                    INNER JOIN attachment
                                    ON order_attachment.AttachmentID=attachment.ID
                                    WHERE order_attachment.ScreenID = (SELECT order_sale.ID
                                    FROM order_sale
                                    WHERE order_sale.SaleID = ?
                                    ORDER BY id DESC LIMIT 1)", [Auth::user()->id]);

        return view('order/order6', compact('data_attachment', 'id_order', 'data_order_attachment', 'id_screen'));
    }

    public function addattachment(Request $request,$id_screen)
    {
        // if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
        //     abort(404, 'Page NotFound');
        // }

        //IMPRESSION
        if ($request->IMPRESSION != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '3'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->IMPRESSION','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '3'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->IMPRESSION','$id_screen')", []);
        }
        if ($request->IMPRESSION == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '3' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '3' ", []);
        }

        //STUDY_MODEL
        if ($request->STUDY_MODEL != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '4'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->STUDY_MODEL','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '4'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->STUDY_MODEL','$id_screen')", []);
        }
        if ($request->STUDY_MODEL == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '4' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '4' ", []);
        }

        //TRANSFER SCREW
        if ($request->TRANSFER_SCREW != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '5'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->TRANSFER_SCREW','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '5'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->TRANSFER_SCREW','$id_screen')", []);
        }
        if ($request->TRANSFER_SCREW == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '5' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '5' ", []);
        }

        //BITE
        if ($request->BITE != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '6'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->BITE','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '6'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->BITE','$id_screen')", []);
        }
        if ($request->BITE == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '6' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '6' ", []);
        }

        //คู่สบ
        if ($request->คู่สบ != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '7'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->คู่สบ','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '7'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->คู่สบ','$id_screen')", []);
        }
        if ($request->คู่สบ == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '7' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '7' ", []);
        }

        //ARTICULATOR
        if ($request->ARTICULATOR != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '8'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->ARTICULATOR','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '8'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->ARTICULATOR','$id_screen')", []);
        }
        if ($request->ARTICULATOR == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '8' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '8' ", []);
        }

        //IMPRESSION_CAP
        if ($request->IMPRESSION_CAP != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '9'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->IMPRESSION_CAP','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '9'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->IMPRESSION_CAP','$id_screen')", []);
        }
        if ($request->IMPRESSION_CAP == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '9' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '9' ", []);
        }

        //IMPRESSION_COPING
        if ($request->IMPRESSION_COPING != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '10'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->IMPRESSION_COPING','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '10'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->IMPRESSION_COPING','$id_screen')", []);
        }
        if ($request->IMPRESSION_COPING == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '10' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '10' ", []);
        }

        //SCREW_ABUTMENT
        if ($request->SCREW_ABUTMENT != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '11'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->SCREW_ABUTMENT','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '11'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->SCREW_ABUTMENT','$id_screen')", []);
        }
        if ($request->SCREW_ABUTMENT == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '11' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '11' ", []);
        }

        //ANALOG
        if ($request->ANALOG != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '12'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->ANALOG','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '12'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->ANALOG','$id_screen')", []);
        }
        if ($request->ANALOG == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '12' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '12' ", []);
        }

        //ABUTMENT
        if ($request->ABUTMENT != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '13'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->ABUTMENT','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '13'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->ABUTMENT','$id_screen')", []);
        }
        if ($request->ABUTMENT == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '13' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '13' ", []);
        }

        //SCREW_DRIVER
        if ($request->SCREW_DRIVER != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '14'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->SCREW_DRIVER','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '14'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->SCREW_DRIVER','$id_screen')", []);
        }
        if ($request->SCREW_DRIVER == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '14' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '14' ", []);
        }

        //HEALING
        if ($request->HEALING != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '15'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->HEALING','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '15'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->HEALING','$id_screen')", []);
        }
        if ($request->HEALING == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '15' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '15' ", []);
        }

        //กล่องงาน
        if ($request->กล่องงาน != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '16'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->กล่องงาน','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '16'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->กล่องงาน','$id_screen')", []);
        }
        if ($request->กล่องงาน == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '16' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '16' ", []);
        }

        //WORKING MODEL
        if ($request->WORKING_MODEL != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '17'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->WORKING_MODEL','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '17'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->WORKING_MODEL','$id_screen')", []);
        }
        if ($request->WORKING_MODEL == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '17' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '17' ", []);
        }

        //DIE
        if ($request->DIE != null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '18'", []);
            // DB::insert("INSERT INTO order_attachment (AttachmentID, ScreenID) values ('$request->DIE','$id_screen')", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '18'", []);
            DB::insert("INSERT INTO order_attachment_screen (AttachmentID, ScreenID) values ('$request->DIE','$id_screen')", []);
        }
        if ($request->DIE == null) {
            // DB::delete("DELETE FROM order_attachment WHERE ScreenID = '$id_screen' AND AttachmentID = '18' ", []);
            DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '18' ", []);
        }

        // $id_order = $id_screen;
        // order_attachment::delete_attachment($id_order);
        DB::delete("DELETE FROM order_attachment_screen WHERE ScreenID = '$id_screen' AND AttachmentID = '0'", []);

        $other = $request->other;
        // order_sale::update_etc($other);
        // DB::update("UPDATE order_sale SET comment = '$other' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // order_screen::update_etc($other);
        DB::update("UPDATE order_screen SET comment = '$other' WHERE order_screen.ID = ?", [$id_screen]);

        // $data_all = order_screen::select_customer($id_screen);
        // $teeth = order_teeth::screen_teeth_group_order_screen($id_screen);
        // $data_order_attachment = DB::select("SELECT
        //             order_attachment.AttachmentID,attachment.Name
        //             FROM
        //             order_attachment
        //             INNER JOIN attachment
        //             ON order_attachment.AttachmentID=attachment.ID
        //             WHERE order_attachment.ScreenID = ?", [$id_screen]);

        // return view('screen.select_teeth.teeth3',compact('teeth','id_screen','data_all','data_order_attachment','data_all'));
        return redirect('/mainscreen/teeth/detail/'.$id_screen);
        // return redirect('/order7');
    }
}
