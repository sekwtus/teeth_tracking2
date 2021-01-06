<?php

namespace App\Http\Controllers;

use App\order_sale;
use App\order_attachment;
use App\order_teeth;
use Gate;
use DB;
use Auth;

class order7_controller extends Controller
{
    public function index()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        // $data_all = order_sale::select_customer();
        $data_all = DB::select("SELECT
                    order_sale.ID,
                    order_sale.Barcode,
                    order_sale.RefBarcode,
                    customer.Name AS 'customer',
                    doctor.Name AS 'doctor',
                    customer_type.Name AS 'customer_type',
                    order_sale.SaleID,
                    order_sale.StartDate,
                    order_sale.DeliverDate,
                    type_Deliver.Name AS 'DeliverType',
                    order_sale.PatientHN,
                    order_sale.PatientName,
                    order_sale.PatientSex,
                    order_sale.PatientAge,
                    order_sale.comment,
                    order_sale.created_at,
                    order_sale.updated_at
                    FROM
                    order_sale
                    INNER JOIN type_Deliver
                    ON type_Deliver.ID=order_sale.DeliverType
                    INNER JOIN customer
                    ON customer.ID=order_sale.CustomerID
                    INNER JOIN doctor
                    ON doctor.ID=order_sale.DoctorID
                    INNER JOIN customer_type
                    ON customer.CustomerTypeID=customer_type.id
                    WHERE order_sale.SaleID = ?
                    ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // $data_order_attachment = order_attachment::select_order_attachment();
        $data_order_attachment = DB::select("SELECT
                    order_attachment.AttachmentID,attachment.Name
                    FROM
                    order_attachment
                    INNER JOIN attachment
                    ON order_attachment.AttachmentID=attachment.ID
                    WHERE order_attachment.OrderID = (SELECT order_sale.ID
                    FROM order_sale
                    WHERE order_sale.SaleID = ?
                    ORDER BY id DESC LIMIT 1)", [Auth::user()->id]);
        // $teeth = order_teeth::select_teeth_group();

        return view('order.order7', compact('data_all', 'data_order_attachment'));
    }

    public function index_save()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        DB::update("UPDATE order_sale SET updated_at = NOW() WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        DB::update("UPDATE order_screen SET updated_at = NOW() WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return redirect('/order');
    }
}
