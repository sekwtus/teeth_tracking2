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
use App\sub_department;
use Session;
class service_controller extends Controller
{
    public function getIndex($id) {
        $data_Employee = Employee::where('ID_user', Auth::user()->id)->limit(1)->first();
        // return $id;

        $Subdepartment_id = "";
        $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?",[Auth::user()->id]);
        foreach($Subdepartment as $out_Subdepartment){
            $Subdepartment_id = $out_Subdepartment->Sub_DepartmentID;
        }
        $mian_department = sub_department::where('ID',$id)->limit(1)->first();

        $select_data_job1 = job::select_job($id,$Subdepartment_id);
        $select_data_job =  DB::select("SELECT
                                        job.ID,
                                        job.ID_order_screen,
                                        job.`status`,
                                        job.date_time_start,
                                        job.date_time_finish,
                                        job.Note_QC,
                                        job.Note_Service,
                                        job.Service_ID,
                                        order_screen.Barcode,
                                        order_screen.PatientName,
                                        order_screen.phone_doctor,
                                        order_screen.line_doctor,
                                        doctor.ID AS doctor_ID,
                                        doctor.`Name` AS name_doctor,
                                        doctor.Phone as phone_doctor,
                                        doctor.Line_doctor as line_doctor,
                                        job.job_current_department,
                                        department.`Name` AS job_current_department,
                                        Employee.ID_user,
                                        Employee.Nick_name as Name_Service
                                        FROM
                                        job
                                        LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                                        LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                                        LEFT JOIN department ON job.job_current_department = department.ID
                                        LEFT JOIN Employee ON job.Service_ID = Employee.ID
                                        WHERE
                                        job.`status` = 6 AND
                                        order_screen.Barcode IS NOT NULL",[]);
                                        
        $select_data_job_admin =  DB::select("SELECT
                            job.ID,
                            job.ID_order_screen,
                            job.`status`,
                            job.date_time_start,
                            job.date_time_finish,
                            job.Note_QC,
                            job.Note_Service,
                            job.Service_ID,
                            order_screen.Barcode,
                            order_screen.PatientName,
                            doctor.ID AS doctor_ID,
                            doctor.`Name` as name_doctor,
                            doctor.Line_doctor as line_doctor,
                            doctor.Phone as phone_doctor,
                            job.job_current_department,
                            department.`Name` as job_current_department,
                            Employee.Nick_name as Name_Service
                            FROM
                            job
                            LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                            LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                            LEFT JOIN department ON job.job_current_department = department.ID
                            LEFT JOIN Employee ON job.Service_ID = Employee.ID
                            WHERE
                            job.`status` =  6 AND
                            order_screen.Barcode IS NOT NULL");

        $select_data_job_contacted =  DB::select("SELECT
                            job.ID,
                            job.ID_order_screen,
                            job.`status`,
                            job.date_time_start,
                            job.date_time_finish,
                            job.Note_QC,
                            job.Note_Service,
                            order_screen.Barcode,
                            order_screen.PatientName,
                            order_screen.phone_doctor,
                            order_screen.line_doctor,
                            doctor.ID AS doctor_ID,
                            doctor.`Name` as name_doctor,
                            doctor.Line_doctor as line_doctor,
                            doctor.Phone as phone_doctor,
                            job.job_current_department,
                            department.`Name` as job_current_department,
                            Employee.Nick_name as Name_Service
                            FROM
                            job
                            LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                            LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                            LEFT JOIN department ON job.job_current_department = department.ID
                            LEFT JOIN Employee ON job.Service_ID = Employee.ID
                            WHERE
                            job.`status` = 7",[]);

        $select_data_job_contacted_admin =  DB::select("SELECT
                    job.ID,
                    job.ID_order_screen,
                    job.`status`,
                    job.date_time_start,
                    job.date_time_finish,
                    job.Note_QC,
                    job.Note_Service,
                    order_screen.Barcode,
                    order_screen.PatientName,
                    doctor.ID AS doctor_ID,
                    doctor.`Name` AS name_doctor,
                    job.job_current_department,
                    department.`Name` AS job_current_department,
                    doctor.Line_doctor AS line_doctor,
                    doctor.Phone AS phone_doctor,
                    Employee.Nick_name as Name_Service
                    FROM
                    job
                    LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                    LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                    LEFT JOIN department ON job.job_current_department = department.ID
                    LEFT JOIN Employee ON job.Service_ID = Employee.ID
                    WHERE
                    job.`status` = 7");

        return view('Job.service',compact('select_data_job_contacted','select_data_job','select_data_job1','id','select_data_job_admin','select_data_job_contacted_admin','data_Employee'));
    }


    public function add_service($id_job,Request $request){

        $count = count($request->job);
        $message_alert_Nobarcode = '';

        // ถ้ามีบาร์โค้ดในlogแล้วสแกนซ้ำ ให้ยกเลิกอันเก่า เพิ่มอันใหม่
        for ($i = 0; $i < $count; $i++) {
            $order_screen = DB::select("SELECT order_screen.ID,order_screen.Barcode FROM order_screen where Barcode = ?",[$request->job[$i]]);
            $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?",[Auth::user()->id]);
            if($order_screen != null ){
                $job = job::where('ID_order_screen', $order_screen[0]->ID)->limit(1)->first();
                if($job->status == 5){
                    // 5->ส่งต่อบริการ

                    //6 รอติดต่อหมอ
                    DB::update("UPDATE job SET job.job_current_department = 4 , job.status = 6 WHERE job.ID_order_screen  = ?", [$order_screen[0]->ID]);

                    $main_department = $id_job;
                    DB::update("UPDATE job_detail SET job_detail.status_job_detail = '2'
                    WHERE job_detail.JobID = ? AND job_detail.DepartmentID = ? AND job_detail.Sub_DepartmentID = ?"
                    , [$job->ID,$main_department,$Subdepartment[0]->Sub_DepartmentID]);

                    DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,EmployeeID,status_job_detail,
                    created_at,DepartmentID,Sub_DepartmentID)
                    VALUES (?,?,?,'6',now(),?,?)", [$job->ID,$order_screen[0]->ID,Auth::user()->id,4,$Subdepartment[0]->Sub_DepartmentID]);

                    // update log service
                    DB::update("UPDATE log_job_service SET log_job_service.status_job_detail = '4'
                    WHERE log_job_service.JobID = ? AND log_job_service.DepartmentID = ? AND log_job_service.Sub_DepartmentID = ?"
                    , [$job->ID,$id_job,$Subdepartment[0]->Sub_DepartmentID]);

                    // insert log service status 2
                    DB::insert("INSERT INTO log_job_service (JobID,status_job_detail,created_at,DepartmentID,Sub_DepartmentID)
                    VALUES (?,'2',now(),'4',?)", [$job->ID,$Subdepartment[0]->Sub_DepartmentID]);
                }else{
                    $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
                }
            }else{
                $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
            }
        }

        if($message_alert_Nobarcode != ''){
            Session::flash('message', "ไม่สามารถเพิ่มบาร์โค๊ด ".$message_alert_Nobarcode." ได้");
        }
        return redirect('/service'.'/'.$id_job);
    }

    public function send_to_service($id,$id_job,Request $request){
        DB::insert("INSERT INTO job_detail (job_status,JobID,DepartmentID,status_job_detail,EmployeeID,ID_order_screen,created_at,Sub_DepartmentID,Note_QC,Note_Service)
        SELECT 7,JobID,4,7,?,ID_order_screen,?,10,'$request->noteQC','$request->noteService' FROM job_detail
        WHERE JobID = ? limit 1", [Auth::user()->id,now(),$id_job]); // 7 status บริการ ติดต่อหมอแล้ว / 4 department service /10 sub_depart service

        DB::insert("INSERT INTO log_job_service (JobID,DepartmentID,status_job_detail,Note_QC,Note_Service,created_at,Sub_DepartmentID)
        SELECT JobID,5,3,'$request->noteQC','$request->noteService',?,Sub_DepartmentID FROM job_detail
        WHERE JobID = ? AND status_job_detail = '1' limit 1", [now(),$id_job]);

        DB::update("UPDATE job SET job.status = 7 ,Note_QC = '$request->noteQC', Note_Service = '$request->noteService' WHERE job.ID = ? ", [$id_job]);

        return redirect('/service'.'/'.$id);
    }

    public function send_to_teeth($id,$id_job,Request $request){

        $job_check = job::where('ID', $id_job)->first();

        DB::insert("INSERT INTO job_detail (JobID,DepartmentID,status_job_detail,EmployeeID,ID_order_screen,created_at,Sub_DepartmentID)
        VALUES (?,1000,8,?,?,NOW(),51)", [$id_job,Auth::user()->id,$job_check->ID_order_screen]);

        DB::update("UPDATE job SET job.job_current_department = 1000 , job.status = 2 WHERE job.ID = ? ", [$id_job]);
        DB::update("UPDATE order_teeth_screen SET order_teeth_screen.editable = 0 WHERE order_teeth_screen.ScreenID = ? ", [$job_check->ID_order_screen]);
        DB::update("UPDATE order_screen SET order_screen.note_edit_teeth = ? WHERE order_screen.ID = ? ", [$request->Noteteeth,$job_check->ID_order_screen]);


        return redirect('/service'.'/'.$id);
    }

    public function edit_doctor($id,$id_doc,Request $request){
         
        DB::update("UPDATE doctor SET name = ?, Phone = ?, Line_doctor = ? WHERE ID = ?",[$request->name,$request->phone_doctor,$request->line_doctor,$id_doc]);
        return redirect()->back();
    }
}
