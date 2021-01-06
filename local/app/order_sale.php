<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class order_sale extends Model
{
    protected $table = 'order_sale';

    public static function select_Deliver()
    {
        $sql = "SELECT type_Deliver.ID,type_Deliver.`Name` FROM type_Deliver";
        return DB::select($sql , []);
    }

    public static function select_id_sale()
    {
        $sql = "SELECT
                    order_sale.ID
                    FROM
                    order_sale
                    WHERE order_sale.SaleID = ?
                    ORDER BY id DESC LIMIT 1";

        return DB::select($sql , [Auth::user()->id]);
    }

    public static function select_customer()
    {
        $sql = "SELECT
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
                    ORDER BY id DESC LIMIT 1";

        return DB::select($sql , [Auth::user()->id]);
    }

    public static function update_CustomerID($radio)
    {
        DB::update("UPDATE order_sale SET CustomerID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_DoctorID($radio)
    {
        DB::update("UPDATE order_sale SET DoctorID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_Patient($PatientName,$PatientHN,$PatientAge,$PatientSex)
    {
        DB::update("UPDATE order_sale SET PatientName = '$PatientName', PatientHN = '$PatientHN', PatientAge = '$PatientAge', PatientSex = '$PatientSex' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_FactoryID($radio)
    {
        DB::update("UPDATE order_sale SET FactoryID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_BranchID($radio)
    {
        DB::update("UPDATE order_sale SET BranchID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_Area($radio)
    {
        DB::update("UPDATE order_sale SET AreaID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_etc($other)
    {
        DB::update("UPDATE order_sale SET comment = '$other' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function delete_main()
    {
        DB::delete("DELETE FROM order_sale WHERE order_sale.SaleID = ? AND updated_at is NULL", [Auth::user()->id]);
    }
}
