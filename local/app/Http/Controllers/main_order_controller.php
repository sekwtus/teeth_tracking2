<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use DB;
use Auth;
use Gate;
use App\order_sale;
use App\order_screen;

class main_order_controller extends Controller
{
    public function getIndex()
    {
        // if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
        //     abort(404, 'Page NotFound');
        // }


        DB::delete("DELETE FROM order_sale WHERE order_sale.SaleID = ? AND updated_at is NULL", [Auth::user()->id]);
        DB::delete('DELETE FROM order_screen WHERE order_screen.SaleID = ? AND updated_at is NULL', [Auth::user()->id]);


        // $order_sale = DB::select("SELECT
        //     order_screen.ID,
        //     order_screen.Barcode,
        //     order_screen.RefBarcode,
        //     customer.`Name` AS customer,
        //     doctor.`Name` AS doctor,
        //     customer_type.`name` AS customer_type,
        //     order_screen.SaleID,
        //     order_screen.StartDate,
        //     order_screen.DeliverDate,
        //     order_screen.ReceptionTime,
        //     type_Deliver.`Name` AS DeliverType,
        //     order_screen.PatientHN,
        //     order_screen.PatientName,
        //     order_screen.PatientSex,
        //     order_screen.PatientAge,
        //     order_screen.comment,
        //     order_screen.created_at,
        //     order_screen.updated_at,
        //     Employee.Nick_name AS 'Employee',
        //     department.`Name` as department
        //     FROM
        //     order_screen
        //     INNER JOIN Employee ON Employee.ID=order_screen.SaleID
        //     INNER JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        //     INNER JOIN customer ON customer.ID = order_screen.CustomerID
        //     INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
        //     INNER JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        //     LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        //     LEFT JOIN department ON job.job_current_department = department.ID
        //     WHERE order_screen.SaleID = ? AND job.job_current_department != 7 OR job.job_current_department IS NULL
        //     ORDER BY order_screen.StartDate DESC",
        //     [Auth::user()->id]); //AND job.job_current_department != 7

        $order_sale = DB::select("SELECT
                                order_screen.ID,
                                order_screen.Barcode,
                                order_screen.RefBarcode,
                                order_screen.FactoryID,
                                order_screen.BranchID,
                                order_screen.CustomerID,
                                order_screen.DoctorID,
                                order_screen.SaleID,
                                order_screen.StartDate,
                                order_screen.DeliverDate,
                                order_screen.DeliverType,
                                order_screen.PatientHN,
                                order_screen.PatientName,
                                order_screen.PatientSex,
                                order_screen.PatientAge,
                                order_screen.created_at,
                                order_screen.updated_at,
                                order_screen.ReceptionTime,
                                order_screen.`comment`,
                                order_screen.AreaID,
                                customer.`Name` AS customer,
                                doctor.`Name` AS doctor,
                                customer_type.`name` AS customer_type,
                                type_Deliver.`Name` AS DeliverType,
                                Employee.Nick_name AS 'Employee',
                                department.`Name` as department,
                                area.Name AS 'area'
                                FROM
                                order_screen
                                LEFT JOIN area ON order_screen.AreaID = area.ID 
                                LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
                                LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                                LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                                LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                                LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                                LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                                LEFT JOIN department ON job.job_current_department = department.ID
                                WHERE order_screen.SaleID = ? AND (job.job_current_department != 7
                                OR job.job_current_department IS NULL)
                                ORDER BY order_screen.id DESC",[Auth::user()->id]);

        $teeth = DB::select('SELECT
                                order_teeth.ID,
                                order_teeth.OrderID,
                                order_teeth.TeethID,
                                order_teeth.TypeOfWorkID,
                                order_teeth.TypeOfProductID,
                                order_teeth.TypeOfGroupID,
                                order_teeth.GroupNo,
                                type_of_work.`Name` AS NameWork,
                                type_of_product.`Name` AS NameProduct,
                                type_of_group.`Name` AS NameGroup
                                FROM
                                order_teeth
                                LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                                LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                                LEFT JOIN type_of_group ON order_teeth.TypeOfGroupID = type_of_group.ID', []);

        $data_order_attachment = DB::select('SELECT
                                order_attachment_screen.OrderID,
                                order_attachment_screen.ScreenID,
                                order_attachment_screen.AttachmentID,
                                attachment.Name
                                FROM
                                order_attachment_screen
                                INNER JOIN attachment
                                ON order_attachment_screen.AttachmentID=attachment.ID', []);

        // $order_sale_complete = DB::select("SELECT
        //                         order_screen.ID,
        //                         order_screen.Barcode,
        //                         order_screen.RefBarcode,
        //                         customer.`Name` AS customer,
        //                         doctor.`Name` AS doctor,
        //                         customer_type.`name` AS customer_type,
        //                         order_screen.SaleID,
        //                         order_screen.StartDate,
        //                         order_screen.DeliverDate,
        //                         order_screen.ReceptionTime,
        //                         type_Deliver.`Name` AS DeliverType,
        //                         order_screen.PatientHN,
        //                         order_screen.PatientName,
        //                         order_screen.PatientSex,
        //                         order_screen.PatientAge,
        //                         order_screen.created_at,
        //                         order_screen.updated_at,
        //                         Employee.Nick_name AS 'Employee',
        //                         department.`Name` as department
        //                         FROM
        //                         order_screen
        //                         LEFT JOIN area ON area.ID=order_screen.AreaID
        //                         LEFT JOIN Employee ON Employee.ID=order_screen.SaleID
        //                         LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        //                         LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        //                         LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        //                         LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        //                         LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        //                         LEFT JOIN department ON job.job_current_department = department.ID
        //                         WHERE
        //                         order_screen.SaleID = ? AND job.job_current_department = 7", [Auth::user()->id]);

        $order_sale_complete = DB::select("SELECT
                                order_screen.ID,
                                order_screen.Barcode,
                                order_screen.RefBarcode,
                                order_screen.FactoryID,
                                order_screen.BranchID,
                                order_screen.CustomerID,
                                order_screen.DoctorID,
                                order_screen.SaleID,
                                order_screen.StartDate,
                                order_screen.DeliverDate,
                                order_screen.DeliverType,
                                order_screen.PatientHN,
                                order_screen.PatientName,
                                order_screen.PatientSex,
                                order_screen.PatientAge,
                                order_screen.created_at,
                                order_screen.updated_at,
                                order_screen.ReceptionTime,
                                order_screen.`comment`,
                                order_screen.AreaID,
                                customer.`Name` AS customer,
                                doctor.`Name` AS doctor,
                                customer_type.`name` AS customer_type,
                                type_Deliver.`Name` AS DeliverType,
                                Employee.Nick_name AS 'Employee',
                                department.`Name` as department,
                                area.Name AS 'area'
                                FROM
                                order_screen
                                LEFT JOIN area ON order_screen.AreaID = area.ID 
                                LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
                                LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                                LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                                LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                                LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                                LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                                LEFT JOIN department ON job.job_current_department = department.ID
                                WHERE
                                order_screen.SaleID = ? AND job.job_current_department = 7
                                ORDER BY order_screen.id DESC", [Auth::user()->id]);

        //return $data_order_attachment;
        return view('order/mainorder', compact('order_sale', 'teeth', 'data_order_attachment', 'order_sale_complete'));
    }

    public function getIndex_com()
    {
        // if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
        //     abort(404, 'Page NotFound');
        // }


        DB::delete("DELETE FROM order_sale WHERE order_sale.SaleID = ? AND updated_at is NULL", [Auth::user()->id]);
        DB::delete('DELETE FROM order_screen WHERE order_screen.SaleID = ? AND updated_at is NULL', [Auth::user()->id]);


        // $order_sale = DB::select("SELECT
        //     order_screen.ID,
        //     order_screen.Barcode,
        //     order_screen.RefBarcode,
        //     customer.`Name` AS customer,
        //     doctor.`Name` AS doctor,
        //     customer_type.`name` AS customer_type,
        //     order_screen.SaleID,
        //     order_screen.StartDate,
        //     order_screen.DeliverDate,
        //     order_screen.ReceptionTime,
        //     type_Deliver.`Name` AS DeliverType,
        //     order_screen.PatientHN,
        //     order_screen.PatientName,
        //     order_screen.PatientSex,
        //     order_screen.PatientAge,
        //     order_screen.comment,
        //     order_screen.created_at,
        //     order_screen.updated_at,
        //     Employee.Nick_name AS 'Employee',
        //     department.`Name` as department
        //     FROM
        //     order_screen
        //     INNER JOIN Employee ON Employee.ID=order_screen.SaleID
        //     INNER JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        //     INNER JOIN customer ON customer.ID = order_screen.CustomerID
        //     INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
        //     INNER JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        //     LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        //     LEFT JOIN department ON job.job_current_department = department.ID
        //     WHERE order_screen.SaleID = ? AND job.job_current_department != 7 OR job.job_current_department IS NULL
        //     ORDER BY order_screen.StartDate DESC",
        //     [Auth::user()->id]); //AND job.job_current_department != 7

        $order_sale = DB::select("SELECT
                                order_screen.ID,
                                order_screen.Barcode,
                                order_screen.RefBarcode,
                                order_screen.FactoryID,
                                order_screen.BranchID,
                                order_screen.CustomerID,
                                order_screen.DoctorID,
                                order_screen.SaleID,
                                order_screen.StartDate,
                                order_screen.DeliverDate,
                                order_screen.DeliverType,
                                order_screen.PatientHN,
                                order_screen.PatientName,
                                order_screen.PatientSex,
                                order_screen.PatientAge,
                                order_screen.created_at,
                                order_screen.updated_at,
                                order_screen.ReceptionTime,
                                order_screen.`comment`,
                                order_screen.AreaID,
                                customer.`Name` AS customer,
                                doctor.`Name` AS doctor,
                                customer_type.`name` AS customer_type,
                                type_Deliver.`Name` AS DeliverType,
                                Employee.Nick_name AS 'Employee',
                                department.`Name` as department,
                                area.Name AS 'area'
                                FROM
                                order_screen
                                LEFT JOIN area ON order_screen.AreaID = area.ID 
                                LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
                                LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                                LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                                LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                                LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                                LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                                LEFT JOIN department ON job.job_current_department = department.ID
                                WHERE order_screen.SaleID = ? AND (job.job_current_department != 7
                                OR job.job_current_department IS NULL)
                                ORDER BY order_screen.id DESC",[Auth::user()->id]);

        $teeth = DB::select('SELECT
                                order_teeth.ID,
                                order_teeth.OrderID,
                                order_teeth.TeethID,
                                order_teeth.TypeOfWorkID,
                                order_teeth.TypeOfProductID,
                                order_teeth.TypeOfGroupID,
                                order_teeth.GroupNo,
                                type_of_work.`Name` AS NameWork,
                                type_of_product.`Name` AS NameProduct,
                                type_of_group.`Name` AS NameGroup
                                FROM
                                order_teeth
                                LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                                LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                                LEFT JOIN type_of_group ON order_teeth.TypeOfGroupID = type_of_group.ID', []);

        $data_order_attachment = DB::select('SELECT
                                order_attachment_screen.OrderID,
                                order_attachment_screen.ScreenID,
                                order_attachment_screen.AttachmentID,
                                attachment.Name
                                FROM
                                order_attachment_screen
                                INNER JOIN attachment
                                ON order_attachment_screen.AttachmentID=attachment.ID', []);

        // $order_sale_complete = DB::select("SELECT
        //                         order_screen.ID,
        //                         order_screen.Barcode,
        //                         order_screen.RefBarcode,
        //                         customer.`Name` AS customer,
        //                         doctor.`Name` AS doctor,
        //                         customer_type.`name` AS customer_type,
        //                         order_screen.SaleID,
        //                         order_screen.StartDate,
        //                         order_screen.DeliverDate,
        //                         order_screen.ReceptionTime,
        //                         type_Deliver.`Name` AS DeliverType,
        //                         order_screen.PatientHN,
        //                         order_screen.PatientName,
        //                         order_screen.PatientSex,
        //                         order_screen.PatientAge,
        //                         order_screen.created_at,
        //                         order_screen.updated_at,
        //                         Employee.Nick_name AS 'Employee',
        //                         department.`Name` as department
        //                         FROM
        //                         order_screen
        //                         LEFT JOIN area ON area.ID=order_screen.AreaID
        //                         LEFT JOIN Employee ON Employee.ID=order_screen.SaleID
        //                         LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        //                         LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        //                         LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        //                         LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        //                         LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        //                         LEFT JOIN department ON job.job_current_department = department.ID
        //                         WHERE
        //                         order_screen.SaleID = ? AND job.job_current_department = 7", [Auth::user()->id]);

        $order_sale_complete = DB::select("SELECT
                                order_screen.ID,
                                order_screen.Barcode,
                                order_screen.RefBarcode,
                                order_screen.FactoryID,
                                order_screen.BranchID,
                                order_screen.CustomerID,
                                order_screen.DoctorID,
                                order_screen.SaleID,
                                order_screen.StartDate,
                                order_screen.DeliverDate,
                                order_screen.DeliverType,
                                order_screen.PatientHN,
                                order_screen.PatientName,
                                order_screen.PatientSex,
                                order_screen.PatientAge,
                                order_screen.created_at,
                                order_screen.updated_at,
                                order_screen.ReceptionTime,
                                order_screen.`comment`,
                                order_screen.AreaID,
                                customer.`Name` AS customer,
                                doctor.`Name` AS doctor,
                                customer_type.`name` AS customer_type,
                                type_Deliver.`Name` AS DeliverType,
                                Employee.Nick_name AS 'Employee',
                                department.`Name` as department,
                                area.Name AS 'area'
                                FROM
                                order_screen
                                LEFT JOIN area ON order_screen.AreaID = area.ID 
                                LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
                                LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                                LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                                LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                                LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                                LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                                LEFT JOIN department ON job.job_current_department = department.ID
                                WHERE
                                order_screen.SaleID = ? AND job.job_current_department = 7
                                ORDER BY order_screen.id DESC", [Auth::user()->id]);

        //return $data_order_attachment;
        return view('order/mainorder_com', compact('order_sale', 'teeth', 'data_order_attachment', 'order_sale_complete'));
    }

    public function getOrderDetail(Request $request, $id)
    {
        if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

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
                                    order_sale.created_at,
                                    order_sale.updated_at,
                                    order_sale.user_id
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
                                    WHERE order_sale.ID = ?
                                    ORDER BY id DESC LIMIT 1", [$id]);

        $data_order_attachment = DB::select('SELECT
                                                order_attachment.AttachmentID,attachment.Name
                                                FROM
                                                order_attachment
                                                INNER JOIN attachment
                                                ON order_attachment.AttachmentID=attachment.ID
                                                WHERE order_attachment.OrderID = (SELECT order_sale.ID
                                                FROM order_sale
                                                WHERE order_sale.ID = ?
                                                ORDER BY id DESC LIMIT 1)', [$id]);

        $teeth = DB::select('SELECT
                                order_teeth.ID,
                                order_teeth.OrderID,
                                order_teeth.TeethID,
                                order_teeth.TypeOfWorkID,
                                order_teeth.TypeOfProductID,
                                order_teeth.TypeOfGroupID,
                                order_teeth.GroupNo,
                                type_of_work.`Name` AS NameWork,
                                type_of_product.`Name` AS NameProduct,
                                type_of_group.`Name` AS NameGroup

                                FROM
                                order_teeth
                                LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                                LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                                LEFT JOIN type_of_group ON order_teeth.TypeOfGroupID = type_of_group.ID
                                WHERE
                                order_teeth.OrderID = ( SELECT order_sale.ID FROM order_sale WHERE order_sale.ID = ? ORDER BY id DESC LIMIT 1 ) AND
                                order_teeth.ID IN (( SELECT MAX( order_teeth.ID ) FROM order_teeth GROUP BY order_teeth.TeethID ))', [$id]);

        //show order step 7
        return view('order.order_detail', compact('data_all', 'data_order_attachment', 'teeth'));
    }
}
