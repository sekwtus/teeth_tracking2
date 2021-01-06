<?php

namespace App\Http\Controllers;

use DataTables;
use DB;
use App\doctor;
use App\company;
use App\order_screen;
use Gate;
use Auth;

class datatable_controller extends Controller
{
    public function order()
    {
        $search_customer = (!empty($_GET["search_customer"])) ? ($_GET["search_customer"]) : ('');
        $search_zone = (!empty($_GET["search_zone"])) ? ($_GET["search_zone"]) : ('');
        $search_area = (!empty($_GET["search_area"])) ? ($_GET["search_area"]) : ('');
        $search_work_type = (!empty($_GET["search_work_type"])) ? ($_GET["search_work_type"]) : ('');
        $search_depart = (!empty($_GET["search_depart"])) ? ($_GET["search_depart"]) : ('');
        $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('');

        $order_sale = DB::select("SELECT
                    order_screen.ID,
                    order_screen.Barcode,
                    users.ID_area AS 'ID_area',
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
                    customer.`Name` AS customer,
                    doctor.`Name` AS doctor,
                    customer_type.`name` AS customer_type,
                    type_Deliver.`Name` AS DeliverType,
                    Employee.Nick_name AS 'Employee',
                    department.`Name` as department,
                    area.Name AS AreaID,
                    job.job_current_sub_department
                    FROM
                    order_screen
                    LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
                    LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                    LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                    LEFT JOIN area ON order_screen.AreaID = area.ID
                    LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                    LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                    LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                    LEFT JOIN department ON job.job_current_department = department.ID
                    LEFT JOIN users ON users.id = order_screen.SaleID
                    WHERE order_screen.SaleID = ? 	AND order_screen.updated_at IS NOT NULL
                    AND (job.job_current_department != 7 AND job.job_current_department != 997
                    OR job.job_current_department IS NULL)
                    ORDER BY order_screen.ID DESC
                    ", [Auth::user()->id]);

        return Datatables::of($order_sale)->make(true);
    }

    public function order_complete()
    {
        $order_sale_complete = DB::select("SELECT
                    order_screen.ID,
                    order_screen.Barcode,
                    users.ID_area AS 'ID_area',
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
                    customer.`Name` AS customer,
                    doctor.`Name` AS doctor,
                    customer_type.`name` AS customer_type,
                    type_Deliver.`Name` AS DeliverType,
                    Employee.Nick_name AS 'Employee',
                    department.`Name` as department,
                    area.Name AS AreaID
                    FROM
                    order_screen
                    LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
                    LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                    LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                    LEFT JOIN area ON order_screen.AreaID = area.ID
                    LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                    LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                    LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                    LEFT JOIN department ON job.job_current_department = department.ID
                    LEFT JOIN users ON users.id = order_screen.SaleID
                    WHERE
                    order_screen.SaleID = ? AND job.job_current_department = 7
                    ORDER BY order_screen.id DESC
                    ", [Auth::user()->id]);

        return Datatables::of($order_sale_complete)->make(true);
    }

    public function order_doctor()
    {
        $order_doctor = DB::select("SELECT
                    order_screen.ID,
                    order_screen.Barcode,
                    users.ID_area AS 'ID_area',
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
                    LEFT JOIN users ON users.id = order_screen.SaleID
                    WHERE
                    order_screen.SaleID = ? AND job.job_current_department = '997'
                    ORDER BY order_screen.id DESC
                    ", [Auth::user()->id]);

        return Datatables::of($order_doctor)->make(true);
    }

    public function screen_doctor()
    {
        $screen_doctor = DB::select("SELECT
                    order_screen.ID,
                    order_screen.Barcode,
                    users.ID_area AS 'ID_area',
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
                    area.Name AS 'area',
                    order_sale.Datefinal
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
                    LEFT JOIN users ON users.id = order_screen.SaleID,
                    order_sale
                    WHERE
                    job.job_current_department = '994' AND
                    order_screen.Barcode = order_sale.Barcode
                    ORDER BY order_screen.id DESC
                    ", [Auth::user()->id]);

        return Datatables::of($screen_doctor)->make(true);
    }

    public function screen_teeth()
    {
    //     $data_teeth = DB::select("SELECT
    //     order_screen.ID,
    //     order_screen.SaleID,
    //     users.ID_area AS ID_area,
    //     order_screen.Barcode,
    //     order_screen.RefBarcode,
    //     order_screen.ContiBarcode,
    //     order_screen.FactoryID,
    //     order_screen.CustomerID,
    //     order_screen.PatientName,
    //     customer.`Name` AS customer,
    //     doctor.`Name` AS doctor,
    //     Employee.Nick_name AS Employee,
    //     order_screen.DoctorID,
    //     order_screen.SaleID,
    //     DATE_FORMAT( order_screen.StartDate, '%d' ) AS StartDateday,
    //     DATE_FORMAT( order_screen.StartDate, '%m' ) AS StartDatemount,
    //     DATE_FORMAT( order_screen.StartDate, '%Y' ) + 543 AS StartDateyear,
    //     order_screen.StartDate,
    //     order_screen.DeliverDate,
    //     str_to_date( order_screen.StartDate, '%d/%m/%Y' ) AS d,
    //     Count( order_teeth_screen.ScreenID ) AS count,
    //     order_teeth_screen.editable,
    //     order_screen.Datefinal,
    //     area.`Name` AS AreaID
    // FROM
    //     order_screen
    //     INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
    //     INNER JOIN customer ON customer.ID = order_screen.CustomerID
    //     INNER JOIN users ON users.id = order_screen.SaleID
    //     INNER JOIN Employee ON Employee.ID_user = order_screen.SaleID
    //     LEFT JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID
    //     LEFT JOIN area ON customer.AreaID = area.ID
    // GROUP BY
    //     order_screen.ID
    // HAVING
    //     count < 1
    //     OR order_teeth_screen.editable = '0'
    // ORDER BY
    //     order_screen.ID DESC", []);


            $data_teeth = DB::select("SELECT
            order_screen.ID,
            order_screen.SaleID,
            users.ID_area AS ID_area,
            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.FactoryID,
            order_screen.CustomerID,
            order_screen.PatientName,
            doctor.`Name` AS doctor,
            doctor.Line_doctor AS line_doctor,
            doctor.Phone AS phone_doctor,
            customer.`Name` AS customer,
            Employee.Nick_name AS Employee,
            order_screen.DoctorID,
            order_screen.SaleID,
            DATE_FORMAT( order_screen.StartDate, '%d' ) AS StartDateday,
            DATE_FORMAT( order_screen.StartDate, '%m' ) AS StartDatemount,
            DATE_FORMAT( order_screen.StartDate, '%Y' ) + 543 AS StartDateyear,
            order_screen.StartDate,
            order_screen.DeliverDate,
            order_screen.Datefinal,
            area.`Name` AS AreaID
        FROM
            order_screen
            INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
            INNER JOIN customer ON customer.ID = order_screen.CustomerID
            INNER JOIN users ON users.id = order_screen.SaleID
            INNER JOIN Employee ON Employee.ID_user = order_screen.SaleID
            LEFT JOIN area ON order_screen.AreaID = area.ID
        WHERE
            -- (order_screen.status_screen IS NULL)
            order_screen.status_screen IS NULL AND order_screen.created_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
            AND order_screen.updated_at IS NOT NULL
        ORDER BY
            order_screen.ID DESC", []);

        return Datatables::of($data_teeth)->addIndexColumn()->make(true);
    }

    public function screen()
    {
        $data_order = DB::select("SELECT
        order_screen.ID,
        order_screen.SaleID,
        users.ID_area AS ID_area,
        order_screen.Barcode,
        order_screen.RefBarcode,
        order_screen.FactoryID,
        order_screen.CustomerID,
        order_screen.PatientName,
        doctor.`Name` AS doctor,
        doctor.Phone AS phone_doctor,
        doctor.Line_doctor AS line_doctor,
        customer.`Name` AS customer,
        Employee.Nick_name AS Employee,
        order_screen.DoctorID,
        order_screen.SaleID,
        DATE_FORMAT( order_screen.StartDate, '%d' ) AS StartDateday,
        DATE_FORMAT( order_screen.StartDate, '%m' ) AS StartDatemount,
        DATE_FORMAT( order_screen.StartDate, '%Y' ) + 543 AS StartDateyear,
        order_screen.StartDate,
        order_screen.DeliverDate,
        -- order_teeth_screen.editable,
        -- order_teeth_screen.`status` AS `status`,
        -- Sum( order_teeth_screen.`status` ) AS sumstatus,
        -- Count( order_teeth_screen.ScreenID ) AS count,
        order_screen.Datefinal,
        area.`Name` AS AreaID
    FROM
        order_screen
        LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        LEFT JOIN users ON users.id = order_screen.SaleID
        LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
        LEFT JOIN (SELECT * FROM order_teeth_screen) as order_teeth_screen ON order_screen.ID = order_teeth_screen.ScreenID
        LEFT JOIN area ON order_screen.AreaID = area.ID
    WHERE
        order_screen.status_screen IS NULL
        -- OR
        --  order_teeth_screen.editable = '1'
    GROUP BY
        order_teeth_screen.ScreenID
    ORDER BY
        order_screen.ID DESC", []);

$data_order2 = DB::select("SELECT
    order_screen.ID,
    order_screen.SaleID,
    users.ID_area AS ID_area,
    order_screen.Barcode,
    order_screen.RefBarcode,
    order_screen.FactoryID,
    order_screen.CustomerID,
    order_screen.PatientName,
    doctor.`Name` AS doctor,
    doctor.Phone AS phone_doctor,
    doctor.Line_doctor AS line_doctor,
    customer.`Name` AS customer,
    Employee.Nick_name AS Employee,
    order_screen.DoctorID,
    order_screen.SaleID,
    DATE_FORMAT( order_screen.StartDate, '%d' ) AS StartDateday,
    DATE_FORMAT( order_screen.StartDate, '%m' ) AS StartDatemount,
    DATE_FORMAT( order_screen.StartDate, '%Y' ) + 543 AS StartDateyear,
    order_screen.StartDate,
    order_screen.DeliverDate,
    -- order_teeth_screen.editable,
    -- order_teeth_screen.`status` AS `status`,
    -- Sum( order_teeth_screen.`status` ) AS sumstatus,
    -- Count( order_teeth_screen.ScreenID ) AS count,
    order_screen.Datefinal,
    area.`Name` AS AreaID
    FROM
    order_screen
    LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
    LEFT JOIN customer ON customer.ID = order_screen.CustomerID
    LEFT JOIN users ON users.id = order_screen.SaleID
    LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
    LEFT JOIN (SELECT * FROM order_teeth_screen) as order_teeth_screen ON order_screen.ID = order_teeth_screen.ScreenID
    LEFT JOIN area ON order_screen.AreaID = area.ID
    WHERE
    -- order_screen.status_screen IS NULL
    -- OR
    order_teeth_screen.editable = '1'
    GROUP BY
    order_teeth_screen.ScreenID
    ORDER BY
    order_screen.ID DESC", []);

    foreach ($data_order as $key => $value) {
        array_unshift($data_order2,array_shift( $data_order ));
    }
    
        return Datatables::of($data_order2)->addIndexColumn()->make(true);
    }

    public function screen_complete()
    {
//         $data_screen = DB::select("	SELECT
//         order_screen.ID,
//         order_screen.SaleID,
//         users.ID_area AS ID_area,
//         order_screen.Barcode,
//         order_screen.RefBarcode,
//         order_screen.FactoryID,
//         order_screen.CustomerID,
//         order_screen.PatientName,
//         doctor.`Name` AS doctor,
//         customer.`Name` AS customer,
//         Employee.Nick_name AS Employee,
//         order_screen.DoctorID,
//         order_screen.SaleID,
//         DATE_FORMAT(order_screen.StartDate,'%d') AS StartDateday,
//         DATE_FORMAT(order_screen.StartDate,'%m') AS StartDatemount,
//         DATE_FORMAT(order_screen.StartDate,'%Y') + 543 AS StartDateyear,
//         order_screen.StartDate,
//         order_screen.DeliverDate,
//         order_teeth_screen.ScreenID AS OrderID,
//         order_teeth_screen.`status` AS `status`,
//         Sum(order_teeth_screen.`status`) AS sumstatus,
//         Count(order_teeth_screen.ScreenID) AS count,
//         area.`Name` AS AreaID,
//         order_screen.Datefinal
//         FROM
//         order_screen
//         LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
//         LEFT JOIN customer ON customer.ID = order_screen.CustomerID
//         LEFT JOIN users ON users.id = order_screen.SaleID
//         LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
//         LEFT JOIN order_teeth_screen ON order_screen.ID = order_teeth_screen.ScreenID
//         LEFT JOIN area ON customer.AreaID = area.ID
// --         order_sale
//         WHERE
// --         order_screen.Barcode = order_sale.Barcode
// --         AND
//         order_screen.status_screen = '1'
//         GROUP BY
//         order_teeth_screen.ScreenID
//         -- HAVING
//         -- sumstatus = count
//         ORDER BY
//         order_screen.ID DESC", []);
        $search_customer = (!empty($_GET["search_customer"])) ? ($_GET["search_customer"]) : ('NULL');
        $search_zone = (!empty($_GET["search_zone"])) ? ($_GET["search_zone"]) : ('NULL');
        $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('NULL');
        $bracode = (!empty($_GET["bracode"])) ? ($_GET["bracode"]) : ('NULL');
        $search_PatientName = (!empty($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('NULL');

$data_screen = DB::select("	SELECT
            order_screen.ID,
            order_screen.SaleID,
            users.ID_area AS ID_area,
            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.FactoryID,
            order_screen.CustomerID,
            order_screen.PatientName,
            doctor.`Name` AS doctor,
            doctor.Phone as phone_doctor,
            doctor.Line_doctor as line_doctor,
            customer.`Name` AS customer,
            Employee.Nick_name AS Employee,
            order_screen.DoctorID,
            order_screen.SaleID,
            DATE_FORMAT( order_screen.StartDate, '%d' ) AS StartDateday,
            DATE_FORMAT( order_screen.StartDate, '%m' ) AS StartDatemount,
            DATE_FORMAT( order_screen.StartDate, '%Y' ) + 543 AS StartDateyear,
            order_screen.StartDate,
            order_screen.DeliverDate,
            area.`Name` AS AreaID,
            order_screen.Datefinal,
            `customer`.`Name`,
            `order_screen`.`job_current_sub_department`
            FROM
            order_screen
            LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
            LEFT JOIN customer ON customer.ID = order_screen.CustomerID
            LEFT JOIN users ON users.id = order_screen.SaleID
            LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
            LEFT JOIN area ON customer.AreaID = area.ID
            WHERE
            order_screen.status_screen = '1' AND
        (`customer`.`Name` LIKE '%$search_customer%') OR
        (area.`Name` LIKE UPPER('%$search_zone%')) OR
        (`doctor`.`Name` LIKE '%$dentist%') OR
        (order_screen.Barcode LIKE '%$bracode%') OR
        (order_screen.PatientName LIKE '%$search_PatientName%')

            ORDER BY
            order_screen.ID DESC", []);

        return Datatables::of($data_screen)->addIndexColumn()->make(true);
    }

    public function employee()
    {
        if(Auth::user()->ID_type_users == 1 || Auth::user()->ID_type_users == 9){
        $data_Employee = DB::select("SELECT
                                        Employee.ID,
                                        Employee.ID_user,
                                        users.username AS 'username',
                                        users.email AS 'email',
                                        Employee.ID_Employee,
                                        Employee.`Name`,
                                        Employee.Nick_name,
                                        Employee.name_position,
                                        Employee.gender,
                                        Employee.Phone_Number,
                                        Employee.Line_ID,
                                        Employee.department,
                                        Employee.cotton,
                                        type_Branch.Name AS 'type_Branch',
                                        company.Name AS 'company',
                                        Employee.status
                                        FROM
                                        Employee
                                        LEFT JOIN type_Branch
                                        ON type_Branch.ID=Employee.ID_type_Branch
                                        LEFT JOIN company
                                        ON company.ID=Employee.ID_company
                                        LEFT JOIN users
                                        ON users.id=Employee.ID_user", []);
                }elseif (Auth::user()->ID_type_users == 8) {
                    $data_Employee = DB::select("SELECT
                    Employee.ID,
                    Employee.ID_user,
                    users.username AS username,
                    users.email AS email,
                    Employee.ID_Employee,
                    Employee.`Name`,
                    Employee.Nick_name,
                    Employee.name_position,
                    Employee.gender,
                    Employee.Phone_Number,
                    Employee.Line_ID,
                    Employee.department,
                    Employee.cotton,
                    type_Branch.`Name` AS type_Branch,
                    company.`Name` AS company,
                    Employee.status
                FROM
                    Employee
                    INNER JOIN type_Branch ON type_Branch.ID = Employee.ID_type_Branch
                    INNER JOIN company ON company.ID = Employee.ID_company
                    INNER JOIN users ON users.id = Employee.ID_user
                WHERE
                    users.ID_type_users IN ( 2, 8 )", []);
                }

        return Datatables::of($data_Employee)->make(true);
    }

    public function packing()
    {
        $data_order_screen = order_screen::select_data_for_packing();

        return Datatables::of($data_order_screen)->make(true);
    }

    public function packing_complete()
    {
        $data_packing_finish = order_screen::select_data_for_packing_finish();

        return Datatables::of($data_packing_finish)->make(true);
    }

    public function today1()
    {
        if (Gate::allows('IsSale')) {
            $data_packing_finish = order_screen::select_data_for_packing_finish();

            return Datatables::of($data_packing_finish)->make(true);
        } else {
            $data_packing_finish = order_screen::select_data_for_packing_finish();

            return Datatables::of($data_packing_finish)->make(true);
        }
    }

    public function doctor()
    {
        $data_doctor = doctor::all();

        return Datatables::of($data_doctor)->make(true);
    }

    public function customer()
    {
        $data_customer = DB::select("SELECT
                                        customer.ID,
                                        customer.`Name`,
                                        customer_type.name AS 'CustomerType',
                                        area.Name AS 'Area',
                                        customer.CustomerTypeID,
                                        customer.AreaID,
                                        customer.status,
                                        customer.CustomerCode,
                                        customer.CustomerCode2,
                                        customer.short_Name,
                                        customer.NameCustomer1,
                                        customer.NameCustomer2,
                                        customer.send_object,
                                        customer.send_bill,
                                        customer.Tel,
                                        customer.TaxID,
                                        customer.CustomerName
                                        FROM
                                        customer
                                        LEFT JOIN customer_type
                                        ON customer_type.id=customer.CustomerTypeID
                                        LEFT JOIN area
                                        ON area.ID=customer.AreaID", []);

        return Datatables::of($data_customer)->make(true);
    }

    public function service_area()
    {
        $data_area = DB::select("SELECT
                                        area.ID,
                                        area.`Name`,
                                        zone.Name AS 'Area',
                                        area.ZoneID
                                        FROM
                                        area
                                        LEFT JOIN zone
                                        ON zone.ID=area.ZoneID", []);

        return Datatables::of($data_area)->make(true);
    }

    public function company()
    {
        $company = company::all();

        return Datatables::of($company)->make(true);
    }

    public function factory()
    {
        $data_factory = DB::select("SELECT
                                        factory.ID,
                                        factory.`Name`,
                                        company.Name AS 'company',
                                        zone.Name AS 'zone',
                                        factory.CompanyID,
                                        factory.ZoneID
                                        FROM
                                        factory
                                        INNER JOIN company
                                        ON company.ID=factory.CompanyID
                                        INNER JOIN zone
                                        ON zone.ID=factory.ZoneID", []);

        return Datatables::of($data_factory)->make(true);
    }

    public function screen_teeth_90day()
    {
        $search_customer = (!empty($_GET["search_customer"])) ? ($_GET["search_customer"]) : ('NULL');
        $search_area = (!empty($_GET["search_area"])) ? ($_GET["search_area"]) : ('NULL');
        $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('NULL');
        $bracode = (!empty($_GET["bracode"])) ? ($_GET["bracode"]) : ('NULL');
        $search_PatientName = (!empty($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('NULL');


        $data_teeth = DB::select("SELECT
            order_screen.ID,
            order_screen.SaleID,
            users.ID_area AS ID_area,
            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.FactoryID,
            order_screen.CustomerID,
            order_screen.PatientName,
            doctor.`Name` AS doctor,
            doctor.Line_doctor AS line_doctor,
            doctor.Phone AS phone_doctor,
            customer.`Name` AS customer,
            Employee.Nick_name AS Employee,
            order_screen.DoctorID,
            order_screen.SaleID,
            DATE_FORMAT( order_screen.StartDate, '%d' ) AS StartDateday,
            DATE_FORMAT( order_screen.StartDate, '%m' ) AS StartDatemount,
            DATE_FORMAT( order_screen.StartDate, '%Y' ) + 543 AS StartDateyear,
            order_screen.StartDate,
            order_screen.DeliverDate,
            order_screen.Datefinal,
            area.`Name` AS AreaID,
            `customer`.`Name`,
            `order_screen`.`job_current_sub_department`
        FROM
            order_screen
            INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
            INNER JOIN customer ON customer.ID = order_screen.CustomerID
            INNER JOIN users ON users.id = order_screen.SaleID
            INNER JOIN Employee ON Employee.ID_user = order_screen.SaleID
            LEFT JOIN area ON order_screen.AreaID = area.ID
        WHERE
            -- (order_screen.status_screen IS NULL)
            order_screen.status_screen IS NULL AND order_screen.created_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
            AND
            (`customer`.`Name` LIKE '%$search_customer%') OR
            (area.`Name` LIKE UPPER('%$search_area%')) OR
            (`doctor`.`Name` LIKE '%$dentist%') OR
            (order_screen.Barcode LIKE '%$bracode%') OR
            (order_screen.PatientName LIKE '%$search_PatientName%')
        ORDER BY
            order_screen.ID DESC", []);

        return Datatables::of($data_teeth)->addIndexColumn()->make(true);
    }

    //todo report งานแก้
    public function report_work_modify() {
        $search_customer = (!empty($_GET["search_customer"])) ? ($_GET["search_customer"]) : ('NULL');
        $search_area = (!empty($_GET["search_area"])) ? ($_GET["search_area"]) : ('NULL');
        $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('NULL');
        $bracode = (!empty($_GET["bracode"])) ? ($_GET["bracode"]) : ('NULL');
        $search_PatientName = (!empty($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('NULL');


        $work_modify = DB::select("SELECT
            -- SUM(
            --     CASE 
            --         WHEN order_screen.Barcode is not null THEN 1 
            --         -- WHEN order_screen.Barcode != '' THEN 1 
            --     END
            -- ) AS count_new,
            COUNT(order_teeth.TeethID) as count_new,      
            SUM(RefBarcode is not null) as count_modify,
            SUM(ContiBarcode is not null) as count_conti,
            -- Count(order_teeth.TeethID) AS count_product,
            order_teeth.ScreenID,
            type_of_work.`Name`,
            type_of_product.Name AS product_name,
            type_of_product.`group`,

            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.ContiBarcode,
            DATE_FORMAT(order_screen.created_at, '%Y') + 543 AS year_create,
            DATE_FORMAT(order_screen.created_at, '%m') AS month_create,
            order_screen.created_at,
            order_screen.updated_at,
            
            work_defect.name_type, 
            work_defect.detail_type
            
            FROM order_screen

            INNER JOIN order_teeth ON order_teeth.ScreenID = order_screen.ID
            INNER JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
            INNER JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
            LEFT JOIN work_defect ON work_defect.id = order_screen.ddlTypeEdit

            WHERE 1 
                -- AND work_defect.id_type IN (1,2)
                AND order_screen.ddlTypeEdit IS NOT NULL 
                AND order_screen.ddlTypeEdit != ''

            GROUP BY
                order_teeth.TypeOfProductID,
                DATE_FORMAT(order_screen.created_at, '%Y-%m')

            ORDER BY
                order_screen.created_at DESC
        ", []);

        return Datatables::of($work_modify)->addIndexColumn()->make(true);
    }

    //todo report งานเลื่อน
    public function report_work_delay() {
        /*
        $work_dely_old = DB::select("SELECT
            Count(order_screen.ddlWorkLate) AS count_work_late,
            order_screen.ID,
            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.ContiBarcode,
            order_screen.FactoryID,
            order_screen.BranchID,
            order_screen.CustomerID,
            order_screen.DoctorID,
            order_screen.SaleID,
            order_screen.AreaID,
            order_screen.ddlWorkLate,
            order_screen.StartDate,
            order_screen.PatientName,
            order_screen.DeliverDate,
            order_screen.DeliverDate_comment,
            order_screen.Delaydate,
            order_screen.Delaytime,
            order_screen.Employee_DeliverDate_comment,
            order_screen.comment_WorkLate,
            order_screen.comment_WorkLate_before,

            order_screen.Datefinal,
            DATE_FORMAT(order_screen.created_at, '%Y') + 543 AS year_create,
            order_screen.created_at,
            order_screen.updated_at,
            
            work_defect.name_type, 
            work_defect.detail_type

            FROM order_screen
            LEFT JOIN work_defect ON work_defect.id = order_screen.ddlWorkLate

            WHERE 1 
                AND work_defect.id_type IN (3,4)
                AND order_screen.DeliverDate_comment IS NOT NULL 
                AND order_screen.DeliverDate_comment != ''

            GROUP BY
                order_screen.ddlWorkLate

            ORDER BY
                order_screen.created_at DESC
                -- order_screen.ID ASC
        ", []);
        */
        $work_delay = DB::select("SELECT
            COUNT(order_teeth.TeethID) as count_new,      
            SUM(RefBarcode is not null) as count_modify,
            SUM(ContiBarcode is not null) as count_conti,
            
            order_teeth.ScreenID,
            type_of_work.`Name`,
            type_of_product.Name AS product_name,
            type_of_product.`group`,

            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.ContiBarcode,
            DATE_FORMAT(order_screen.created_at, '%Y') + 543 AS year_create,
            DATE_FORMAT(order_screen.created_at, '%m') AS month_create,
            order_screen.created_at,
            order_screen.updated_at,
            
            work_defect.name_type, 
            work_defect.detail_type
            
            FROM order_screen

            INNER JOIN order_teeth ON order_teeth.ScreenID = order_screen.ID
            INNER JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
            INNER JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
            LEFT JOIN work_defect ON work_defect.id = order_screen.ddlTypeEdit

            WHERE 1 
                -- AND work_defect.id_type IN (3,4)
                AND order_screen.ddlWorkLate IS NOT NULL 
                AND order_screen.ddlWorkLate != ''

            GROUP BY
                order_teeth.TypeOfProductID,
                DATE_FORMAT(order_screen.created_at, '%Y-%m')

            ORDER BY
                order_screen.created_at DESC
        ", []);

        return Datatables::of($work_delay)->addIndexColumn()->make(true);
    }
}
