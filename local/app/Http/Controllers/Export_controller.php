<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use Auth;
use DB;
use App\job;
use App\department;
use App\order_screen;
use Gate;
use Session;
use App\job_detail;
use DataTables;

class Export_controller extends Controller
{
    public function getExport($id_job){
        $data_department = 997;
        $id = $id_job;
        $count = DB::select('SELECT
                        Count(user_subDepartments.user_id) as count
                        FROM
                        user_subDepartments
                        WHERE
                        user_subDepartments.user_id = 0
                        GROUP BY
                        user_subDepartments.user_id');
        return view('Job.Export',compact('data_department','id','count'));
    }

    public function getExport_complete(){
        return view('Job.Export_complete_before');
    }

    public function getExport_90day(){
        return view('Job.Export_90day_before');
    }

    public function getAjexOrder_packing(){


        if (Gate::allows('IsAdmin') || (Auth::user()->ID_area == null || Auth::user()->ID_area == '' || Auth::user()->ID_area == 0)) {
            $sql = DB::select('SELECT
            job.job_current_department,
            job.ID_order_screen,
            -- job.date_time_start,
            department.`Name`,
            order_screen.DeliverDate AS DeliverDate,
            order_screen.Barcode,
            order_screen.ID,
            order_screen.DoctorID,
            order_screen.PatientName,
            doctor.`Name` AS doctor_name,
            order_screen.SaleID,
            job_detail.Sub_DepartmentID,
            job_detail.created_at,
            customer.AreaID,
            area.`Name` AS Area,
            type_Branch.`Name` AS Branch,
            zone.name AS zone
            FROM
            job
            LEFT JOIN department ON job.job_current_department = department.ID
            LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
            LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
            LEFT JOIN job_detail ON job.ID = job_detail.JobID
            LEFT JOIN users ON order_screen.SaleID = users.id
            LEFT JOIN customer ON order_screen.CustomerID = customer.ID
            LEFT JOIN area ON customer.AreaID = area.ID
            LEFT JOIN zone ON zone.ID = area.ZoneID
            LEFT JOIN Employee ON job_detail.EmployeeID = Employee.ID
            LEFT JOIN type_Branch ON type_Branch.ID = order_screen.current_employee_id
            WHERE
            job.job_current_department = 3 AND
            job_detail.Sub_DepartmentID = 7
            ', []);
        }else{
            $sql = DB::select('SELECT
            job.job_current_department,
            job.ID_order_screen,
            -- job.date_time_start,
            department.`Name`,
            order_screen.DeliverDate AS DeliverDate,
            order_screen.Barcode,
            order_screen.DoctorID,
            order_screen.PatientName,
            doctor.`Name` AS doctor_name,
            order_screen.SaleID,
            job_detail.Sub_DepartmentID,
            job_detail.created_at,
            area.`Name` AS Area,
            type_Branch.`Name` AS Branch,
            zone.name AS zone,
            customer.AreaID
            FROM
            job
            LEFT JOIN department ON job.job_current_department = department.ID
            LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
            LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
            LEFT JOIN job_detail ON job.ID = job_detail.JobID
            LEFT JOIN users ON order_screen.SaleID = users.id
            LEFT JOIN customer ON order_screen.CustomerID = customer.ID
            LEFT JOIN area ON customer.AreaID = area.ID
            LEFT JOIN zone ON zone.ID = area.ZoneID
            LEFT JOIN Employee ON job_detail.EmployeeID = Employee.ID
            LEFT JOIN type_Branch ON type_Branch.ID = order_screen.current_employee_id
            WHERE
            job.job_current_department = 3 AND
            job_detail.Sub_DepartmentID = 7 AND
            customer.AreaID = ?', [Auth::user()->ID_area]);

        }

return Datatables::of($sql )->make(true);
}

    public function getAjexOrder_packed(){
        $bracode = (!empty($_GET["bracode"])) ? ($_GET["bracode"]) : ('NULL');
        $search_zone = (!empty($_GET["search_zone"])) ? ($_GET["search_zone"]) : ('NULL');
        $search_area = (!empty($_GET["search_area"])) ? ($_GET["search_area"]) : ('NULL');
        $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('NULL');
        $search_PatientName = (!empty($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('NULL');

        if (Gate::allows('IsAdmin') || (Auth::user()->ID_area == null || Auth::user()->ID_area == '' || Auth::user()->ID_area == 0)) {
                    $sql= DB::select("SELECT
                    job.job_current_department,
                    job.ID_order_screen,
                    department.`Name`,
                    order_screen.Barcode,
                    order_screen.DoctorID,
                    order_screen.PatientName,
                    doctor.`Name` AS doctor_name,
                    order_screen.SaleID,
                    job.updated_at,
                    order_screen.CustomerID,
                    customer.AreaID,
                    customer.`Name`,
                    type_Branch.Name AS branch,
                    area.`Name` AS Area,
                    zone.name AS zone
                FROM
                    job
                    LEFT JOIN department ON job.job_current_department = department.ID
                    LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                    LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                    LEFT JOIN customer ON order_screen.CustomerID = customer.ID
                    LEFT JOIN area ON customer.AreaID = area.ID
                    LEFT JOIN type_Branch ON type_Branch.ID = order_screen.current_employee_id
                    LEFT JOIN zone ON zone.ID = area.ZoneID
                WHERE
                    job.job_current_department = 997
                    AND ((area.`Name` LIKE UPPER('%$search_area%')) OR
                                (order_screen.Barcode LIKE '%$bracode%') OR
                                (zone.Name LIKE '%$search_zone%') OR
                                (doctor.`Name` LIKE '%$dentist%') OR
                                (order_screen.PatientName LIKE '%$search_PatientName%')
                                )
                ORDER BY
                    job.updated_at ASC");
        }else{
                        $sql = DB::select("SELECT
                        job.job_current_department,
                        job.ID_order_screen,
                        department.`Name`,
                        order_screen.Barcode,
                        order_screen.DoctorID,
                        order_screen.PatientName,
                        doctor.`Name` AS doctor_name,
                        order_screen.SaleID,
                        job.updated_at,
                        order_screen.CustomerID,
                        customer.AreaID ,
                        type_Branch.Name AS branch,
                        area.`Name` AS Area,
                        customer.`Name`,
                        zone.name AS zone
                        FROM
                        job
                        LEFT JOIN department ON job.job_current_department = department.ID
                        LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                        LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                        LEFT JOIN customer ON order_screen.CustomerID = customer.ID
                        LEFT JOIN area ON customer.AreaID = area.ID
                        LEFT JOIN type_Branch ON type_Branch.ID = order_screen.current_employee_id
                        LEFT JOIN zone ON zone.ID = area.ZoneID
                        WHERE
                        job.job_current_department = 997
                        AND ((area.`Name` LIKE UPPER('%$search_area%')) OR
                                (order_screen.Barcode LIKE '%$bracode%') OR
                                (zone.Name LIKE '%$search_zone%') OR
                                (doctor.`Name` LIKE '%$dentist%') OR
                                (order_screen.PatientName LIKE '%$search_PatientName%')
                                )
                        AND customer.AreaID = ?
                        ORDER BY
                        job.updated_at ASC
                        ", [Auth::user()->ID_area]);
        }

    return Datatables::of($sql )->make(true);
    }

    public function getAjexOrder_packed_90day(){
        $bracode = (!empty($_GET["bracode"])) ? ($_GET["bracode"]) : ('NULL');
        $search_zone = (!empty($_GET["search_zone"])) ? ($_GET["search_zone"]) : ('NULL');
        $search_area = (!empty($_GET["search_area"])) ? ($_GET["search_area"]) : ('NULL');
        $dentist = (!empty($_GET["dentist"])) ? ($_GET["dentist"]) : ('NULL');
        $search_PatientName = (!empty($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('NULL');

        if (Gate::allows('IsAdmin') || (Auth::user()->ID_area == null || Auth::user()->ID_area == '' || Auth::user()->ID_area == 0)) {
                    $sql= DB::select("SELECT
                    job.job_current_department,
                    job.ID_order_screen,
                    department.`Name`,
                    order_screen.Barcode,
                    order_screen.DoctorID,
                    order_screen.PatientName,
                    doctor.`Name` AS doctor_name,
                    order_screen.SaleID,
                    job.updated_at,
                    order_screen.CustomerID,
                    customer.AreaID,
                    type_Branch.Name AS branch,
                    area.`Name` AS Area,
                    zone.name AS zone
                FROM
                    job
                    LEFT JOIN department ON job.job_current_department = department.ID
                    LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                    LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                    LEFT JOIN customer ON order_screen.CustomerID = customer.ID
                    LEFT JOIN area ON customer.AreaID = area.ID
                    LEFT JOIN type_Branch ON type_Branch.ID = order_screen.current_employee_id
                    LEFT JOIN zone ON zone.ID = area.ZoneID
                WHERE
                    job.job_current_department = 997 AND job.updated_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
                    AND ((area.`Name` LIKE UPPER('%$search_area%')) OR
                                (order_screen.Barcode LIKE '%$bracode%') OR
                                (zone.Name LIKE'%$search_zone%') OR
                                (doctor.`Name` LIKE '%$dentist%') OR
                                (order_screen.PatientName LIKE '%$search_PatientName%')
                                )
                ORDER BY
                    job.updated_at ASC");
        }else{
                        $sql = DB::select("SELECT
                        job.job_current_department,
                        job.ID_order_screen,
                        department.`Name`,
                        order_screen.Barcode,
                        order_screen.DoctorID,
                        order_screen.PatientName,
                        doctor.`Name` AS doctor_name,
                        order_screen.SaleID,
                        job.updated_at,
                        order_screen.CustomerID,
                        customer.AreaID ,
                        type_Branch.Name AS branch,
                        area.`Name` AS Area,
                        zone.name AS zone,
                        customer.`Name`
                        FROM
                        job
                        LEFT JOIN department ON job.job_current_department = department.ID
                        LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                        LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                        LEFT JOIN customer ON order_screen.CustomerID = customer.ID
                        LEFT JOIN area ON customer.AreaID = area.ID
                        LEFT JOIN type_Branch ON type_Branch.ID = order_screen.current_employee_id
                        LEFT JOIN zone ON zone.ID = area.ZoneID
                        WHERE
                        job.job_current_department = 997
                        AND customer.AreaID = ?
                        AND job.updated_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
                        AND ((area.`Name` LIKE UPPER('%$search_area%')) OR
                                (order_screen.Barcode LIKE '%$bracode%') OR
                                (zone.Name LIKE '%$search_zone%') OR
                                (doctor.`Name` LIKE '%$dentist%') OR
                                (order_screen.PatientName LIKE '%$search_PatientName%')
                                )
                        ORDER BY
                        job.updated_at ASC
                        ", [Auth::user()->ID_area]);
        }

    return Datatables::of($sql )->make(true);
    }


        public function add_job(Request $request,$id_job){
            $count = count($request->Barcode);
            $message_alert_Nobarcode = '';

            for ($i = 0; $i < $count; $i++) {
                $Barcode_DB = DB::select("SELECT order_screen.Barcode,order_screen.ID FROM  order_screen where Barcode =  ?",[$request->Barcode[$i]]);
                if($Barcode_DB != null ){

                    $check_inRule = job_detail::where('ID_order_screen','=',$Barcode_DB[0]->ID)
                    ->where('DepartmentID','=','3')
                    ->where('Sub_DepartmentID','=','7')
                    ->leftJoin('order_screen','job_detail.ID_order_screen','=','order_screen.ID')->limit(1)->first();//ผ่านแพ็ค?

                    if (!empty($check_inRule)) {
                        $screen = order_screen::where('Barcode',$request->Barcode[$i])->limit(1)->first();
                        job::update_job_detail($id_job,$screen->ID);

                        if($screen->SaleID != Auth::user()->id)
                        {
                            DB::update("UPDATE order_screen SET SaleID_Close = ? WHERE Barcode = ?", [Auth::user()->id,$request->Barcode[$i]]);
                        }
                    }else {
                        $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->Barcode[$i];
                    }
                    // if ($check_inRule->SaleID != Auth::user()->id) {
                    //     Session::flash('message', "บาร์โค๊ดนี้เป็นของเซลล์ท่านอื่น");
                    //     return redirect('/Export'.'/'.$id_job);
                    // }
                    // else if($check_inRule->DepartmentID == 3){ //3->packing
                    //     $screen = order_screen::where('Barcode',$request->Barcode[$i])->limit(1)->first();
                    //     job::update_job_detail($id_job,$screen->ID);
                    //     // job::insert_job_detail($id_job,$screen->ID);
                    // }else{
                    //     $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->Barcode[$i];
                    // }
                }else{
                    $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->Barcode[$i];
                }
            }


            if($message_alert_Nobarcode != ''){
                Session::flash('message', "กรุณาแพ๊คงาน บาร์โค๊ด ".$message_alert_Nobarcode."");
            }
            return redirect('/transport'.'/'.$id_job);
            // return $request->all();
        }
}
