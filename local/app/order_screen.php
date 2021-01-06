<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class order_screen extends Model
{
    use SoftDeletes;
    protected $table = 'order_screen';

    public static function select_id_screen()
    {
        $sql = 'SELECT
                    order_screen.ID
                    FROM
                    order_screen
                    WHERE order_screen.SaleID = ?
                    ORDER BY id DESC LIMIT 1';

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function select_customer($id)
    {
        $sql = "SELECT
                    order_screen.ID,
                    order_screen.Barcode,
                    order_screen.RefBarcode,
                    customer.Name AS 'customer',
                    doctor.Name AS 'doctor',
                    customer_type.Name AS 'customer_type',
                    order_screen.SaleID,
                    order_screen.StartDate,
                    order_screen.DeliverDate,
                    type_Deliver.Name AS 'DeliverType',
                    order_screen.PatientHN,
                    order_screen.PatientName,
                    order_screen.PatientSex,
                    order_screen.PatientAge,
                    order_screen.comment,
                    order_screen.created_at,
                    order_screen.updated_at
                    FROM
                    order_screen
                    INNER JOIN type_Deliver
                    ON type_Deliver.ID=order_screen.DeliverType
                    INNER JOIN customer
                    ON customer.ID=order_screen.CustomerID
                    INNER JOIN doctor
                    ON doctor.ID=order_screen.DoctorID
                    INNER JOIN customer_type
                    ON customer.CustomerTypeID=customer_type.id
                    WHERE order_screen.ID = ?";

        return DB::select($sql, [$id]);
    }

    public static function select_data_for_packing()
    {
        $sql = 'SELECT
        customer.`Name`,
        order_screen.Barcode,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.ID,
        order_screen.PatientName,
        doctor.`Name` AS doctorname,
        job.ID AS ID_JOB
        FROM
        customer
        INNER JOIN order_screen ON order_screen.CustomerID = customer.ID
        INNER JOIN doctor ON order_screen.DoctorID = doctor.ID
        INNER JOIN job ON job.ID_order_screen = order_screen.ID
        WHERE
        job.job_current_department = 7';

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function select_data_today()
    {
        $sql = 'SELECT
        order_screen.Barcode,
        order_screen.RefBarcode,
        doctor.`Name` AS doctor,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.ReceptionTime,
        order_screen.PatientName,
        users.ID_area,
        order_screen.ID,
        company.`Name` AS company_name,
        customer.`Name` AS customer_name,
        job.ID AS ID_JOB
        FROM
        order_screen
        INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
        INNER JOIN users ON order_screen.SaleID = users.id
        INNER JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
        INNER JOIN company ON type_Branch.companyID = company.ID
        INNER JOIN customer ON order_screen.CustomerID = customer.ID
        INNER JOIN job ON job.ID_order_screen = order_screen.ID
        WHERE
        job.job_current_department = 997
        ';

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function select_data_today_by_area($id)
    {
        $sql = "SELECT
                order_screen.Barcode,
                order_screen.RefBarcode,
                doctor.`Name` AS doctor,
                order_screen.StartDate,
                order_screen.DeliverDate,
                order_screen.ReceptionTime,
                order_screen.PatientName,
                users.ID_area,
                order_screen.ID,
                company.`Name` AS company_name,
                customer.`Name` AS customer_name,
                job.ID AS ID_JOB
                FROM
                order_screen
                INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
                INNER JOIN users ON order_screen.SaleID = users.id
                INNER JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                INNER JOIN company ON type_Branch.companyID = company.ID
                INNER JOIN customer ON order_screen.CustomerID = customer.ID
                INNER JOIN job ON job.ID_order_screen = order_screen.ID
                WHERE
                users.ID_area = $id AND
                job.job_current_department = 997
                AND job.updated_at >= CURRENT_DATE ( )
                ";

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function select_area_today()
    {
        $sql = 'SELECT
        order_screen.SaleID,
        users.ID_area
        FROM
        order_screen
        INNER JOIN users ON users.id = order_screen.SaleID
        INNER JOIN job ON job.ID_order_screen = order_screen.ID
        WHERE
        users.ID_area IS NOT NULL
        AND job.updated_at >= CURRENT_DATE()
        GROUP BY
        users.ID_area';

        return DB::select($sql, [Auth::user()->id]);
    }

    // forSaler

    public static function select_data_today_forSaler()
    {
        $sql = 'SELECT
        order_screen.Barcode,
        order_screen.RefBarcode,
        doctor.`Name` AS doctor,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.ReceptionTime,
        order_screen.PatientName,
        users.ID_area,
        order_screen.ID,
        company.`Name` AS company_name,
        customer.`Name` AS customer_name,
        job.ID as ID_JOB
        FROM
        order_screen
        INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
        INNER JOIN users ON order_screen.SaleID = users.id
        INNER JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
        INNER JOIN company ON type_Branch.companyID = company.ID
        INNER JOIN customer ON order_screen.CustomerID = customer.ID
        INNER JOIN job ON job.ID_order_screen = order_screen.ID
        WHERE
        order_screen.SaleID = ? AND
        job.job_current_department = 997
        ';

        return DB::select($sql, [Auth::user()->id]);
    }

    // end

    public static function select_data_for_packing_detail($id)
    {
        $sql = "SELECT
        customer.`Name`,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.ID,
        order_screen.PatientName,
        doctor.`Name` AS doctorname
        FROM
        customer
        INNER JOIN order_screen ON order_screen.CustomerID = customer.ID
        INNER JOIN doctor ON order_screen.DoctorID = doctor.ID
        WHERE
        order_screen.ID = $id";

        $sql2 = "SELECT
        GROUP_CONCAT(DISTINCT screen.TeethID) AS Teeth_ID
        FROM
        screen
        INNER JOIN order_screen ON screen.ID_order_screen = order_screen.ID
        WHERE
        order_screen.ID = $id";

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function update_CustomerID($radio)
    {
        DB::update("UPDATE order_screen SET CustomerID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_DoctorID($radio)
    {
        DB::update("UPDATE order_screen SET DoctorID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_Patient($PatientName, $PatientHN, $PatientAge, $PatientSex)
    {
        DB::update("UPDATE order_screen SET PatientName = '$PatientName', PatientHN = '$PatientHN', PatientAge = '$PatientAge', PatientSex = '$PatientSex' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_FactoryID($radio)
    {
        DB::update("UPDATE order_screen SET FactoryID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_BranchID($radio)
    {
        DB::update("UPDATE order_screen SET BranchID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_Area($radio)
    {
        DB::update("UPDATE order_screen SET AreaID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function update_etc($other)
    {
        DB::update("UPDATE order_screen SET comment = '$other' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
    }

    public static function select_data_for_packing_finish()
    {
        $sql = "SELECT
        order_screen.ID AS ID,
        order_screen.Barcode AS Barcode,
        order_screen.RefBarcode AS RefBarcode,
        order_screen.ContiBarcode AS ContiBarcode,
        order_screen.StartDate AS StartDate,
        order_screen.DeliverDate AS DeliverDate,
        order_screen.PatientName AS PatientName,
        type_Deliver.`Name` AS deliver_type,
        customer.AreaID AS AreaID,
        customer.`Name` AS `Name`,
        doctor.`Name` AS doctorname,
        processround.production_cycle AS production_cycle,
        area.`Name` AS name_area,
        group_concat( DISTINCT `type_of_product`.`Name` SEPARATOR ' /	' ) AS product_name,
        zone.`Name` AS zone_name,
        company.`Name` AS company_name,
        work_defect.detail_type AS work_edit,
        b.detail_type AS work_late,
        order_screen.job_current_department AS job_current_department,
        order_screen.job_current_sub_department AS current_sub_department,
        department.`Name` AS department,
        sub_department.`Name` AS sub_department_name,
        order_screen.Datefinal,
        order_screen.FactoryID,
        order_screen.OralScan AS OralScan,
        order_screen.PatientHN AS PatientHN,
        order_screen.ReceptionTime AS ReceptionTime
        FROM
        (((((((((((((order_screen
        LEFT JOIN type_Deliver ON ((type_Deliver.ID = order_screen.DeliverType)))
        LEFT JOIN customer ON ((customer.ID = order_screen.CustomerID)))
        LEFT JOIN doctor ON ((doctor.ID = order_screen.DoctorID)))
        LEFT JOIN processround ON ((processround.ID = order_screen.processroundID)))
        JOIN order_teeth_screen ON ((order_teeth_screen.ScreenID = order_screen.ID)))
        LEFT JOIN area ON ((area.ID = customer.AreaID)))
        LEFT JOIN type_of_product ON ((order_teeth_screen.TypeOfProductID = type_of_product.ID)))
        LEFT JOIN zone ON ((zone.ID = area.ZoneID)))
        LEFT JOIN company ON ((company.ID = order_screen.FactoryID)))
        LEFT JOIN work_defect ON ((order_screen.ddlTypeEdit = work_defect.id)))
        LEFT JOIN work_defect AS b ON ((order_screen.ddlWorkLate = b.id)))
        LEFT JOIN department ON ((order_screen.job_current_department = department.ID)))
        LEFT JOIN sub_department ON ((order_screen.job_current_sub_department = sub_department.ID)))
        WHERE
        (order_screen.job_current_department != 997)
        GROUP BY
        order_screen.ID
        ";

        return DB::select($sql);
    }

    public static function select_data_packing_finish()
    {
        $sql = 'SELECT
        customer.`Name`,
        order_screen.Barcode,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.ID,
        order_screen.PatientName,
        doctor.`Name` AS doctorname
    FROM
        order_screen
        INNER JOIN customer ON order_screen.CustomerID = customer.ID
        INNER JOIN doctor ON order_screen.DoctorID = doctor.ID
        INNER JOIN job ON job.ID_order_screen = order_screen.ID
    WHERE
        job.job_current_department = 998
        ';

        return DB::select($sql);
    }

    public static function delete_main()
    {
        DB::delete('DELETE FROM order_screen WHERE order_screen.SaleID = ? AND updated_at is NULL', [Auth::user()->id]);
    }

    public static function select_data_today_finish_forSaler()
    {
        $sql = "SELECT
        order_screen.ID AS ID,
        order_screen.Barcode AS Barcode,
        order_screen.RefBarcode AS RefBarcode,
        order_screen.ContiBarcode AS ContiBarcode,
        order_screen.StartDate AS StartDate,
        order_screen.DeliverDate AS DeliverDate,
        order_screen.PatientName AS PatientName,
        type_Deliver.`Name` AS deliver_type,
        customer.AreaID AS AreaID,
        customer.`Name` AS `Name`,
        doctor.`Name` AS doctorname,
        processround.production_cycle AS production_cycle,
        area.`Name` AS name_area,
        group_concat( DISTINCT `type_of_product`.`Name` SEPARATOR ' /	' ) AS product_name,
        zone.`Name` AS zone_name,
        company.`Name` AS company_name,
        work_defect.detail_type AS work_edit,
        b.detail_type AS work_late,
        order_screen.job_current_department AS job_current_department,
        order_screen.job_current_sub_department AS current_sub_department,
        department.`Name` AS department,
        sub_department.`Name` AS sub_department_name,
        order_screen.Datefinal,
        order_screen.FactoryID,
        order_screen.OralScan AS OralScan,
        order_screen.PatientHN AS PatientHN,
        order_screen.ReceptionTime AS ReceptionTime
        FROM
        (((((((((((((order_screen
        LEFT JOIN type_Deliver ON ((type_Deliver.ID = order_screen.DeliverType)))
        LEFT JOIN customer ON ((customer.ID = order_screen.CustomerID)))
        LEFT JOIN doctor ON ((doctor.ID = order_screen.DoctorID)))
        LEFT JOIN processround ON ((processround.ID = order_screen.processroundID)))
        JOIN order_teeth_screen ON ((order_teeth_screen.ScreenID = order_screen.ID)))
        LEFT JOIN area ON ((area.ID = customer.AreaID)))
        LEFT JOIN type_of_product ON ((order_teeth_screen.TypeOfProductID = type_of_product.ID)))
        LEFT JOIN zone ON ((zone.ID = area.ZoneID)))
        LEFT JOIN company ON ((company.ID = order_screen.FactoryID)))
        LEFT JOIN work_defect ON ((order_screen.ddlTypeEdit = work_defect.id)))
        LEFT JOIN work_defect AS b ON ((order_screen.ddlWorkLate = b.id)))
        LEFT JOIN department ON ((order_screen.job_current_department = department.ID)))
        LEFT JOIN sub_department ON ((order_screen.job_current_sub_department = sub_department.ID)))
        WHERE
        (order_screen.job_current_department = 997)
        GROUP BY
        order_screen.ID
        ";

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function select_data_today_finish()
    {
        $sql = 'SELECT
        order_screen.Barcode,
        order_screen.RefBarcode,
        doctor.`Name` AS doctor,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.ReceptionTime,
        order_screen.PatientName,
        users.ID_area,
        order_screen.ID,
        company.`Name` as company_name,
        customer.`Name` as customer_name,
        job.ID as ID_JOB
        FROM
        order_screen
        INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
        INNER JOIN users ON order_screen.SaleID = users.id
        INNER JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
        INNER JOIN company ON type_Branch.companyID = company.ID
        INNER JOIN customer ON order_screen.CustomerID = customer.ID
        INNER JOIN job ON job.ID_order_screen = order_screen.ID
        WHERE
        job.job_current_department = 995
        AND job.updated_at >= CURRENT_DATE()
        ';

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function select_data_today_finish_by_area($id)
    {
        $sql = "SELECT
                order_screen.Barcode,
                order_screen.RefBarcode,
                doctor.`Name` AS doctor,
                order_screen.StartDate,
                order_screen.DeliverDate,
                order_screen.ReceptionTime,
                order_screen.PatientName,
                users.ID_area,
                order_screen.ID,
                company.`Name` AS company_name,
                customer.`Name` AS customer_name,
                job.ID as ID_JOB
                FROM
                order_screen
                INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
                INNER JOIN users ON order_screen.SaleID = users.id
                INNER JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                INNER JOIN company ON type_Branch.companyID = company.ID
                INNER JOIN customer ON order_screen.CustomerID = customer.ID
                INNER JOIN job ON job.ID_order_screen = order_screen.ID
                WHERE
                users.ID_area = '$id' and
                job.job_current_department = 995
                AND job.updated_at >= CURRENT_DATE()
                ";

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function delete_barcode($order_id){
        $result = order_screen::where('ID',$order_id)->delete();
                return $result;
    }
}
