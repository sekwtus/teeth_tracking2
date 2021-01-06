<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use DB;
use Auth;
use Gate;
use App\order_screen;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\withTrashed;

class work_follower extends Controller
{
    public function index()
    {
        // if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
        //     abort(404, 'Page NotFound');
        // }

        // $order_sale = DB::select('SELECT
        //                        order_screen.ID,
        //                        order_screen.Barcode,
        //                        users.ID_area AS ID_area,
        //                        order_screen.RefBarcode,
        //                        order_screen.ContiBarcode,
        //                        order_screen.FactoryID,
        //                        order_screen.BranchID,
        //                        order_screen.CustomerID,
        //                        order_screen.DoctorID,
        //                        order_screen.SaleID,
        //                        order_screen.StartDate,
        //                        order_screen.DeliverDate,
        //                        order_screen.DeliverType,
        //                        order_screen.PatientHN,
        //                        order_screen.PatientName,
        //                        order_screen.PatientSex,
        //                        order_screen.PatientAge,
        //                        order_screen.created_at,
        //                        order_screen.updated_at,
        //                        order_screen.ReceptionTime,
        //                        order_screen.`comment`,
        //                        order_screen.AreaID,
        //                        customer.`Name` AS customer,
        //                        doctor.`Name` AS doctor,
        //                        customer_type.`name` AS customer_type,
        //                        type_Deliver.`Name` AS DeliverType,
        //                        Employee.Nick_name AS Employee,
        //                        department.`Name` AS department,
        //                        area.`Name` AS name_area,
        //                        GROUP_CONCAT( DISTINCT teeth.Name) AS Teeth_ID,
        //                        GROUP_CONCAT( DISTINCT type_of_product.Name SEPARATOR "/") AS type_of_product,
        //                        order_screen.Datefinal,
        //                        processround.production_cycle,
        //                        job.ID AS ID_job,
        //                        zone.Name AS Zonename,
        //                        company.Name AS company_name,
        //                        sub_department.Name AS sub_department_name,
        //                        job.job_current_department,
        //                        job_detail.DepartmentID
        //                    FROM
        //                        order_screen
        //                        LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
        //                        LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        //                        LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        //                        LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        //                        LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        //                        LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        //                        LEFT JOIN job_detail ON job_detail.JobID = job.ID
        //                        LEFT JOIN department ON job.job_current_department = department.ID
        //                        LEFT JOIN users ON users.id = order_screen.SaleID
        //                        LEFT JOIN area ON area.ID = users.ID_area
        //                        LEFT JOIN zone ON zone.ID = area.ZoneID
        //                        LEFT JOIN screen ON order_screen.ID = screen.ID_order_screen
        //                        LEFT JOIN processround ON processround.ID = order_screen.processroundID
        //                        LEFT JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID
        //                        LEFT JOIN teeth ON teeth.ID = order_teeth_screen.TeethID
        //                        LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
        //                        LEFT JOIN company ON company.ID = order_screen.FactoryID
        //                        LEFT JOIN sub_department ON sub_department.ID = job_detail.Sub_DepartmentID
        //                    WHERE
        //                        ( job.job_current_department != 997 OR job.job_current_department IS NULL )
        //                        AND (job_detail.ID IN (SELECT MAX(id) FROM job_detail GROUP BY job_detail.JobID) OR job_detail.ID is NULL)
        //                        AND order_screen.updated_at IS NOT NULL
        //                        AND order_screen.deleted_at IS NULL
        //                    GROUP BY
        //                        order_screen.Barcode
        //                    ORDER BY
        //                        str_to_date(order_screen.DeliverDate,"%d/%m/%Y") ASC , order_screen.processroundID ASC;
        // ', [Auth::user()->id]);

        // $order_sale_complete = DB::select('SELECT
        //                     order_screen.ID,
        //                     order_screen.Barcode,
        //                     users.ID_area AS ID_area,
        //                     order_screen.RefBarcode,
        //                     order_screen.ContiBarcode,
        //                     order_screen.FactoryID,
        //                     order_screen.BranchID,
        //                     order_screen.CustomerID,
        //                     order_screen.DoctorID,
        //                     order_screen.SaleID,
        //                     order_screen.StartDate,
        //                     order_screen.DeliverDate,
        //                     order_screen.DeliverType,
        //                     order_screen.PatientHN,
        //                     order_screen.PatientName,
        //                     order_screen.PatientSex,
        //                     order_screen.PatientAge,
        //                     order_screen.created_at,
        //                     order_screen.updated_at,
        //                     order_screen.ReceptionTime,
        //                     order_screen.`comment`,
        //                     order_screen.AreaID,
        //                     customer.`Name` AS customer,
        //                     doctor.`Name` AS doctor,
        //                     customer_type.`name` AS customer_type,
        //                     type_Deliver.`Name` AS DeliverType,
        //                     Employee.Nick_name AS Employee,
        //                     department.`Name` AS department,
        //                     area.`Name` AS name_area,
        //                     GROUP_CONCAT( DISTINCT teeth.Name) AS Teeth_ID,
        //                     GROUP_CONCAT( DISTINCT type_of_product.Name SEPARATOR "\r\n") AS type_of_product,
        //                     order_screen.Datefinal,
        //                     processround.production_cycle,
        //                     job.ID AS ID_job,
        //                     zone.Name AS Zonename,
        //                     company.Name AS company_name,
        //                     sub_department.Name AS sub_department_name,
        //                     job.job_current_department,
        //                     job_detail.DepartmentID
        //                 FROM
        //                     order_screen
        //                     LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
        //                     LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        //                     LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        //                     LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        //                     LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        //                     LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        //                     LEFT JOIN job_detail ON job_detail.JobID = job.ID
        //                     LEFT JOIN department ON job.job_current_department = department.ID
        //                     LEFT JOIN users ON users.id = order_screen.SaleID
        //                     LEFT JOIN area ON area.ID = users.ID_area
        //                     LEFT JOIN zone ON zone.ID = area.ZoneID
        //                     LEFT JOIN screen ON order_screen.ID = screen.ID_order_screen
        //                     LEFT JOIN processround ON processround.ID = order_screen.processroundID
        //                     LEFT JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID
        //                     LEFT JOIN teeth ON teeth.ID = order_teeth_screen.TeethID
        //                     LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
        //                     LEFT JOIN company ON company.ID = order_screen.FactoryID
        //                     LEFT JOIN sub_department ON sub_department.ID = job_detail.Sub_DepartmentID
        //                 WHERE
        //                     ( job.job_current_department = 997 )
        //                     AND (job_detail.ID IN (SELECT MAX(id) FROM job_detail GROUP BY job_detail.JobID) OR job_detail.ID is NULL)
        //                 GROUP BY
        //                     order_screen.Barcode
        //                 ORDER BY
        //                     str_to_date(order_screen.DeliverDate,"%d/%m/%Y") DESC
        //                 ', [Auth::user()->id]
        // );

        // $order_sale_complete = DB::select('SELECT * FROM vWork_follwer_orderSaleComplete', [Auth::user()->id]);

        return view('order.work_follower');
    }

    public function index_exported()
    {
        return view('order.work_follower_exported_before');
    }


    public function getAjexOrder(){
        $sql = DB::select('SELECT * FROM `vWork_follwer_orderSale`', [Auth::user()->id]);
        // return $sql;
        return Datatables::of($sql )->addIndexColumn()->make(true);
    }

    public function getAjexOrderComplete(){
        $search_customer = (!empty($_GET["search_customer"])) ? ($_GET["search_customer"]) : ('NULL');
        $search_zone = (!empty($_GET["search_zone"])) ? ($_GET["search_zone"]) : ('NULL');
        $search_area = (!empty($_GET["search_area"])) ? ($_GET["search_area"]) : ('NULL');
        $search_work_type = (!empty($_GET["search_work_type"])) ? ($_GET["search_work_type"]) : ('NULL');
        $search_depart = (!empty($_GET["search_depart"])) ? ($_GET["search_depart"]) : ('NULL');
        $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('NULL');
        $bracode = (!empty($_GET["bracode"])) ? ($_GET["bracode"]) : ('NULL');
        $search_PatientName = (!empty($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('NULL');

        $sql = DB::select("SELECT
        `order_screen`.`ID` AS `ID`,
        `order_screen`.`Barcode` AS `Barcode`,
        `order_screen`.`RefBarcode` AS `RefBarcode`,
        `order_screen`.`ContiBarcode` AS `ContiBarcode`,
        `order_screen`.`StartDate` AS `StartDate`,
        `order_screen`.`DeliverDate` AS `DeliverDate`,
        `order_screen`.`PatientName` AS `PatientName`,
        `type_Deliver`.`Name` AS `DeliverType`,
        `customer`.`AreaID` AS `ID_area`,
        `customer`.`Name` AS `customer`,
        `doctor`.`Name` AS `doctor`,
        `processround`.`production_cycle` AS `production_cycle`,
        `area`.`Name` AS `name_area`,
        group_concat( DISTINCT `type_of_product`.`Name` SEPARATOR ' /	' ) AS `type_of_product`,
        `zone`.`Name` AS `Zonename`,
        `company`.`Name` AS `company_name`,
        `work_defect`.`detail_type` AS `work_edit`,
        `b`.`detail_type` AS `work_late`,
        `order_screen`.`job_current_department` AS `current_department`,
        `order_screen`.`job_current_sub_department` AS `current_sub_department`,
        `department`.`Name` AS `job_current_department`,
        `sub_department`.`Name` AS `job_current_sub_department`,
        `order_screen`.`OralScan` AS `OralScan`,
        `order_screen`.`PatientHN` AS `PatientHN`,
        `order_screen`.`ReceptionTime` AS `ReceptionTime`,
        `order_screen`.`SaleID_Close` AS `SaleID_Close`,
        `order_screen`.`SaleID` AS `SaleID`,
        `type_Branch`.`Name` AS `type_branch_other_sale`,
        `tb`.`Name` AS `type_branch_same_sale`,
         type_of_product.`Name`
    FROM
        (
        (
        (
        (
        (
        (
        (
        (
        (
        (
        (
        (
        (
        (
        (
        (
        ( `order_screen` LEFT JOIN `type_Deliver` ON ( ( `type_Deliver`.`ID` = `order_screen`.`DeliverType` ) ) )
        LEFT JOIN `customer` ON ( ( `customer`.`ID` = `order_screen`.`CustomerID` ) )
        )
        LEFT JOIN `doctor` ON ( ( `doctor`.`ID` = `order_screen`.`DoctorID` ) )
        )
        LEFT JOIN `processround` ON ( ( `processround`.`ID` = `order_screen`.`processroundID` ) )
        )
        JOIN `order_teeth_screen` ON ( ( `order_teeth_screen`.`ScreenID` = `order_screen`.`ID` ) )
        )
        LEFT JOIN `area` ON ( ( `area`.`ID` = `customer`.`AreaID` ) )
        )
        LEFT JOIN `type_of_product` ON ( ( `order_teeth_screen`.`TypeOfProductID` = `type_of_product`.`ID` ) )
        )
        LEFT JOIN `zone` ON ( ( `zone`.`ID` = `area`.`ZoneID` ) )
        )
        LEFT JOIN `company` ON ( ( `company`.`ID` = `order_screen`.`FactoryID` ) )
        )
        LEFT JOIN `work_defect` ON ( ( `order_screen`.`ddlTypeEdit` = `work_defect`.`id` ) )
        )
        LEFT JOIN `work_defect` `b` ON ( ( `order_screen`.`ddlWorkLate` = `b`.`id` ) )
        )
        LEFT JOIN `department` ON ( ( `order_screen`.`job_current_department` = `department`.`ID` ) )
        )
        LEFT JOIN `sub_department` ON ( ( `order_screen`.`job_current_sub_department` = `sub_department`.`ID` ) )
        )
        LEFT JOIN (select * from Employee) as `Employee` ON ( ( `order_screen`.`SaleID_Close` = `Employee`.`ID_user` ) )
        )
        LEFT JOIN `type_Branch` ON ( ( `Employee`.`ID_type_Branch` = `type_Branch`.`ID` ) )
        )
        LEFT JOIN (select * from Employee) as `Emp` ON ( ( `order_screen`.`SaleID` = `Emp`.`ID_user` ) )
        )
        LEFT JOIN `type_Branch` `tb` ON ( ( `Emp`.`ID_type_Branch` = `tb`.`ID` ) )
        )
    WHERE
        ( `order_screen`.`job_current_department` = 997 ) AND ((`area`.`Name` LIKE UPPER('%$search_area%')) OR
        (`customer`.`Name` LIKE '%$search_customer%') OR
        (`zone`.`Name` LIKE '%$search_zone%') OR
        (type_of_product.`Name` LIKE '%$search_work_type%')  OR
        ( `department`.`Name` LIKE '%$search_depart%') OR
        (`doctor`.`Name` LIKE '%$dentist%') OR
        (order_screen.Barcode LIKE '%$bracode%') OR
        (`order_screen`.`PatientName` LIKE '%$search_PatientName%')
        )
    GROUP BY
        `order_screen`.`Barcode`
    ORDER BY
        str_to_date( `order_screen`.`DeliverDate`, '%d/%m/%Y' ) DESC ", [Auth::user()->id]);
        // return $sql;

        return Datatables::of($sql )->addIndexColumn()->make(true);

    }

    public function getAjex(){

        $sql = DB::select('SELECT ID FROM `vWork_follwer_orderSale` LIMIT 1', [Auth::user()->id]);
        // return $sql;
        return Datatables::of($sql )->make(true);
    }

    public function jobcomplete(Request $request, $id)
    {
        $id_job = $id;

        DB::update("UPDATE job SET
                        job_current_department  = '995'
                        WHERE ID = ?
                        ", [$id_job]);

        return redirect('/work_follower');
    }

    public function delete_barcode(Request $request){
        // return $request->barcode;
        DB::delete("DELETE FROM order_screen WHERE ID = '$request->Barcode_ID'");
        // $order_screen = order_screen::delete_barcode($request->barcode);
        // return $request->barcode  . "   " .$order_screen;
        return 'ลบข้อมูลสำเร็จ';
    }



    public function test(){

        $order_sale = DB::select('SELECT
        order_screen.ID,
        order_screen.Barcode,
        users.ID_area AS ID_area,
        order_screen.RefBarcode,
        order_screen.ContiBarcode,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.PatientName,
        customer.`Name` AS customer,
        doctor.`Name` AS doctor,
        type_Deliver.`Name` AS DeliverType,
        department.`Name` AS department,
        area.`Name` AS name_area,
        GROUP_CONCAT( DISTINCT type_of_product.NAME SEPARATOR "\r\n" ) AS type_of_product,
        processround.production_cycle,
        zone.NAME AS Zonename,
        company.NAME AS company_name,
        sub_department.NAME AS sub_department_name,
        job.job_current_department,
        -- job_detail.DepartmentID
    FROM
        order_screen
        LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
        LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        -- LEFT JOIN job_detail ON job_detail.JobID = job.ID
        LEFT JOIN department ON job.job_current_department = department.ID
        LEFT JOIN users ON users.id = order_screen.SaleID
        LEFT JOIN area ON area.ID = users.ID_area
        LEFT JOIN zone ON zone.ID = area.ZoneID
        LEFT JOIN screen ON order_screen.ID = screen.ID_order_screen
        LEFT JOIN processround ON processround.ID = order_screen.processroundID
        LEFT JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID
        LEFT JOIN teeth ON teeth.ID = order_teeth_screen.TeethID
        LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
        LEFT JOIN company ON company.ID = order_screen.FactoryID
        LEFT JOIN sub_department ON sub_department.ID = job.job_current_sub_department
    WHERE
        ( job.job_current_department != 997 OR job.job_current_department IS NULL )
        -- AND (job_detail.ID IN (SELECT MAX(id) FROM job_detail GROUP BY job_detail.JobID) OR job_detail.ID is NULL)
        AND order_screen.updated_at IS NOT NULL
        AND order_screen.deleted_at IS NULL
    GROUP BY
        order_screen.Barcode
    ORDER BY
        str_to_date(order_screen.DeliverDate,"%d/%m/%Y") ASC , order_screen.processroundID ASC;
', [Auth::user()->id]);

        $order_sale_complete = DB::select('SELECT
        order_screen.ID,
        order_screen.Barcode,
        users.ID_area AS ID_area,
        order_screen.RefBarcode,
        order_screen.ContiBarcode,
        order_screen.StartDate,
        order_screen.DeliverDate,
        order_screen.PatientName,
        customer.`Name` AS customer,
        doctor.`Name` AS doctor,
        type_Deliver.`Name` AS DeliverType,
        department.`Name` AS department,
        area.`Name` AS name_area,
        GROUP_CONCAT( DISTINCT type_of_product.NAME SEPARATOR "\r\n" ) AS type_of_product,
        processround.production_cycle,
        zone.NAME AS Zonename,
        company.NAME AS company_name,
        sub_department.NAME AS sub_department_name,
        job.job_current_department,
        job_detail.DepartmentID
    FROM
        order_screen
        LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        LEFT JOIN job ON job.ID_order_screen = order_screen.ID
        LEFT JOIN job_detail ON job_detail.JobID = job.ID
        LEFT JOIN department ON job.job_current_department = department.ID
        LEFT JOIN users ON users.id = order_screen.SaleID
        LEFT JOIN area ON area.ID = users.ID_area
        LEFT JOIN zone ON zone.ID = area.ZoneID
        LEFT JOIN processround ON processround.ID = order_screen.processroundID
        LEFT JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID
        LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
        LEFT JOIN company ON company.ID = order_screen.FactoryID
        LEFT JOIN sub_department ON sub_department.ID = job_detail.Sub_DepartmentID
    WHERE
        ( job.job_current_department = 997 )
        AND ( job_detail.ID IN ( SELECT MAX( id ) FROM job_detail GROUP BY job_detail.JobID ) OR job_detail.ID IS NULL )
    GROUP BY
        order_screen.Barcode
    ORDER BY
        str_to_date( order_screen.DeliverDate, "%d/%m/%Y" ) DESC
                        ', [Auth::user()->id]
        );

    }

    public function index_30day()
    {
        // return view('order.work_follower_30day_before');
        return view('order.work_follower_30day');
    }

    public function getAjexOrder_30day(){
         $sql = DB::select('SELECT * FROM `vWork_follwer_orderSale_30`', [Auth::user()->id]);
    //     // $sql = DB::select('SELECT * FROM `vWork_follwer_orderSale` where created_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW() ', [Auth::user()->id]);
    //     $search_customer = (!empty($_GET["search_customer"])) ? ($_GET["search_customer"]) : ('NULL');
    //     $search_zone = (!empty($_GET["search_zone"])) ? ($_GET["search_zone"]) : ('NULL');
    //     $search_area = (!empty($_GET["search_area"])) ? ($_GET["search_area"]) : ('NULL');
    //     $search_work_type = (!empty($_GET["search_work_type"])) ? ($_GET["search_work_type"]) : ('NULL');
    //     $search_depart = (!empty($_GET["search_depart"])) ? ($_GET["search_depart"]) : ('NULL');
    //     $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('NULL');
    //     $bracode = (!empty($_GET["bracode"])) ? ($_GET["bracode"]) : ('NULL');
    //     $search_PatientName = (!empty($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('NULL');

    //    $sql = DB::select("SELECT
    //     `order_screen`.`ID` AS `ID`,
    //     `order_screen`.`Barcode` AS `Barcode`,
    //     `order_screen`.`RefBarcode` AS `RefBarcode`,
    //     `order_screen`.`ContiBarcode` AS `ContiBarcode`,
    //     `order_screen`.`StartDate` AS `StartDate`,
    //     `order_screen`.`DeliverDate` AS `DeliverDate`,
    //     `order_screen`.`PatientName` AS `PatientName`,
    //     `type_Deliver`.`Name` AS `DeliverType`,
    //     `customer`.`AreaID` AS `ID_area`,
    //     `customer`.`Name` AS `customer`,
    //     `doctor`.`Name` AS `doctor`,
    //     `processround`.`production_cycle` AS `production_cycle`,
    //     `area`.`Name` AS `name_area`,
    //     group_concat( DISTINCT `type_of_product`.`Name` SEPARATOR ' /	' ) AS `type_of_product`,
    //     `zone`.`Name` AS `Zonename`,
    //     `company`.`Name` AS `company_name`,
    //     `work_defect`.`detail_type` AS `work_edit`,
    //     `b`.`detail_type` AS `work_late`,
    //     `order_screen`.`job_current_department` AS `current_department`,
    //     `order_screen`.`job_current_sub_department` AS `current_sub_department`,
    //     `department`.`Name` AS `job_current_department`,
    //     `sub_department`.`Name` AS `job_current_sub_department`,
    //     `order_screen`.`OralScan` AS `OralScan`,
    //     `order_screen`.`PatientHN` AS `PatientHN`,
    //     `order_screen`.`ReceptionTime` AS `ReceptionTime`,
    //     `order_screen`.`SaleID_Close` AS `SaleID_Close`,
    //     `order_screen`.`SaleID` AS `SaleID`,
    //     `type_Branch`.`Name` AS `type_branch_other_sale`,
    //     `tb`.`Name` AS `type_branch_same_sale`,
    //     type_of_product.`Name`
    // FROM
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     (
    //     ( `order_screen` LEFT JOIN `type_Deliver` ON ( ( `type_Deliver`.`ID` = `order_screen`.`DeliverType` ) ) )
    //     LEFT JOIN `customer` ON ( ( `customer`.`ID` = `order_screen`.`CustomerID` ) )
    //     )
    //     LEFT JOIN `doctor` ON ( ( `doctor`.`ID` = `order_screen`.`DoctorID` ) )
    //     )
    //     LEFT JOIN `processround` ON ( ( `processround`.`ID` = `order_screen`.`processroundID` ) )
    //     )
    //     JOIN `order_teeth_screen` ON ( ( `order_teeth_screen`.`ScreenID` = `order_screen`.`ID` ) )
    //     )
    //     LEFT JOIN `area` ON ( ( `area`.`ID` = `customer`.`AreaID` ) )
    //     )
    //     LEFT JOIN `type_of_product` ON ( ( `order_teeth_screen`.`TypeOfProductID` = `type_of_product`.`ID` ) )
    //     )
    //     LEFT JOIN `zone` ON ( ( `zone`.`ID` = `area`.`ZoneID` ) )
    //     )
    //     LEFT JOIN `company` ON ( ( `company`.`ID` = `order_screen`.`FactoryID` ) )
    //     )
    //     LEFT JOIN `work_defect` ON ( ( `order_screen`.`ddlTypeEdit` = `work_defect`.`id` ) )
    //     )
    //     LEFT JOIN `work_defect` `b` ON ( ( `order_screen`.`ddlWorkLate` = `b`.`id` ) )
    //     )
    //     LEFT JOIN `department` ON ( ( `order_screen`.`job_current_department` = `department`.`ID` ) )
    //     )
    //     LEFT JOIN `sub_department` ON ( ( `order_screen`.`job_current_sub_department` = `sub_department`.`ID` ) )
    //     )
    //     LEFT JOIN ( SELECT * FROM Employee ) AS `Employee` ON ( ( `order_screen`.`SaleID_Close` = `Employee`.`ID_user` ) )
    //     )
    //     LEFT JOIN `type_Branch` ON ( ( `Employee`.`ID_type_Branch` = `type_Branch`.`ID` ) )
    //     )
    //     LEFT JOIN ( SELECT * FROM Employee ) AS `Emp` ON ( ( `order_screen`.`SaleID` = `Emp`.`ID_user` ) )
    //     )
    //     LEFT JOIN `type_Branch` `tb` ON ( ( `Emp`.`ID_type_Branch` = `tb`.`ID` ) )
    //     )
    // WHERE
    //     ( `order_screen`.`job_current_department` = 997 ) AND (order_screen.updated_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW())
    //     OR ((`area`.`Name` LIKE UPPER('%$search_area%')) OR
    //     (`customer`.`Name` LIKE '%$search_customer%') OR
    //     (`zone`.`Name` LIKE '%$search_zone%') OR
    //     (type_of_product.`Name` LIKE '%$search_work_type%')  OR
    //     (`department`.`Name` LIKE '%$search_depart%') OR
    //     (`doctor`.`Name` LIKE '%$dentist%') OR
    //     (order_screen.Barcode LIKE '%$bracode%') OR
    //     (`order_screen`.`PatientName` LIKE '%$search_PatientName%')
    //     )
    // GROUP BY
    //     `order_screen`.`Barcode`
    // ORDER BY
    //     str_to_date( `order_screen`.`DeliverDate`, '%d/%m/%Y' )", [Auth::user()->id]);
    //     // return $sql;
        return Datatables::of($sql )->addIndexColumn()->make(true);
    }
}
