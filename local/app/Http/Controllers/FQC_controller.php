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
class FQC_controller extends Controller
{
    public function getIndex($id_job){
        // return $id_job;
        $data_Employee = Employee::where('ID_user', Auth::user()->id)->limit(1)->first();
        $data_department = department::where('ID', $data_Employee->department)->limit(1)->first();
        $Subdepartment_id = "";
        $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?",[Auth::user()->id]);
        foreach($Subdepartment as $out_Subdepartment){
            $Subdepartment_id = $out_Subdepartment->Sub_DepartmentID;
        }
        if($data_Employee->department != $id_job && !Gate::allows('IsAdmin') && !Gate::allows('IsSale')){
            abort(404,"Page NotFound");
        }

        $data_job = job::select_job_current($id_job);
        // $data_job_detail = job::select_job_detail_current($id_job);
        $data_qc_checklist = job::select_qc_checklist($id_job);
        $user_subDepartment= null;

        $id = $id_job;
        $select_data_job = job::select_job($id_job,$Subdepartment_id);
        // $data_employee = job::select_employee_job();
        $Job_ID = array();
        $fqc_checklist = array();
        $data_fqc_checklist = null;
        foreach ($select_data_job as $out_select_data_job){
            $Job_ID[] = $out_select_data_job->ID;
        }
        $count = count($Job_ID);
        for ($i = 0; $i < $count; $i++) {
            $fqc_checklist[] = job::select_fqc_checklist($Job_ID[$i]);
        }
        if(!empty($fqc_checklist) ){
            $data_fqc_checklist = $fqc_checklist[0];
        }

        // $data_department_all = DB::select("SELECT ID,Name FROM department WHERE id < 100");
        // $data_detailjob = job::select_detail_job();
// return $id_job;
        $Sub_department_FQC = DB::select("SELECT
        qcchecklist.sub_department,
        sub_department.`Name`
        FROM
        qcchecklist
        INNER JOIN sub_department ON qcchecklist.sub_department = sub_department.ID
        WHERE
        qcchecklist.sub_department IN ((SELECT
        job_detail.Sub_DepartmentID
        FROM
        job_detail
        WHERE
        job_detail.status_job_detail = 1))
        LIMIT 1");

        // $count = DB::select('SELECT
        //                 Count(user_subDepartments.user_id) as count
        //                 FROM
        //                 user_subDepartments
        //                 WHERE
        //                 user_subDepartments.user_id = 0
        //                 GROUP BY
        //                 user_subDepartments.user_id');


        // $all_subDepartment = DB::select("SELECT
        //                 Employee.Nick_name,
        //                 Employee.name_position,
        //                 Employee.department,
        //                 Employee.ID,
        //                 Count(job_detail.Sub_DepartmentID) AS count_job,
        //                 users.username
        //                 FROM
        //                 Employee
        //                 LEFT JOIN job_detail ON Employee.ID = job_detail.EmployeeID
        //                 LEFT JOIN users ON Employee.ID_user = users.id
        //                 WHERE
        //                 Employee.department = '$id_job'
        //                 GROUP BY
        //                 Employee.ID");

        $detail_emp_Do_subDepartment = DB::select("SELECT
                        job_detail.ID,
                        job_detail.JobID,
                        job_detail.ID_screen,
                        job_detail.ID_order_screen,
                        job_detail.productID,
                        job_detail.DepartmentID,
                        Count(job_detail.Sub_DepartmentID) as count_job,
                        job_detail.Sub_DepartmentID,
                        job_detail.EmployeeID,
                        job_detail.status_job_detail,
                        sub_department.`Name`
                        FROM
                        job_detail
                        LEFT JOIN sub_department ON job_detail.Sub_DepartmentID = sub_department.ID
                        WHERE
                        job_detail.DepartmentID = '$id_job'
                        GROUP BY
                        job_detail.Sub_DepartmentID,
                        job_detail.EmployeeID
                        ORDER BY
                        job_detail.EmployeeID ASC
        ");

        $note = DB::select("SELECT
                    job_detail.ID_order_screen,
                    order_screen.ID,
                    order_screen.note,
                    job_detail.DepartmentID,
                    order_screen.Barcode
                    FROM
                    order_screen
                    INNER JOIN job_detail ON job_detail.ID_order_screen = order_screen.ID
                    WHERE
                    job_detail.DepartmentID = '$id_job'
                    GROUP BY
                    job_detail.ID_order_screen
                    ");

        $Service = DB::select('SELECT
        Employee.ID,
        Employee.Nick_name
        FROM
        Employee
        WHERE
        Employee.department = 4');

        return view('Job.FQC',compact('detail_emp_Do_subDepartment','data_job','data_qc_checklist','data_department','count','user_subDepartment','select_data_job','data_fqc_checklist','id','id_job','note','Sub_department_FQC','Service'));
    }

    public function add_FQC($id_job,Request $request){
        $count = count($request->job);
        $Subdepartment_id = '';
        $message_alert_Nobarcode = '';

        for ($i = 0; $i < $count; $i++) {
            $job = DB::select("SELECT order_screen.Barcode, job.ID FROM job INNER JOIN order_screen ON job.ID_order_screen = order_screen.ID where order_screen.Barcode = ?",[$request->job[$i]]);

            $order_screen = DB::select("SELECT order_screen.ID,order_screen.Barcode FROM order_screen where Barcode = ?",[$request->job[$i]]);
            if($order_screen != null ){
                $check_inRule = job::where('ID_order_screen',$order_screen[0]->ID)->limit(1)->first();
                if($check_inRule->status == 2 || $check_inRule->status == 7){
                    // 2->QCเสร็จ 7->ส่งต่อให้หมอ
                    $now = \Carbon\Carbon::now();
                    $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?",[Auth::user()->id]);
                    job::insert_job($job[0]->ID,$order_screen[0]->ID,Auth::user()->id,$id_job,$Subdepartment[0]->Sub_DepartmentID);
                    DB::update("UPDATE job SET  date_time_start = '$now' , job_current_department = ? ,job.status = '3' WHERE job.ID = ?", [$id_job,$job[0]->ID]);
                }else{
                    $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
                }
            }else{
                $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
            }

        }
        $string = str_replace(' ', '', $message_alert_Nobarcode);
      
        if(empty($string)){
            redirect('/FQC'.'/'.$id_job);
            
        }
        else
        {
            Session::flash('message', "กรุณารับงาน บาร์โค๊ด ".$message_alert_Nobarcode."  ผ่าน QC ก่อน");

        }
        return redirect('/FQC'.'/'.$id_job);
    }

    public function send_to_doctor($id,$id_job,$id_order_screen,Request $request){
        DB::insert("INSERT INTO job_detail (JobID,DepartmentID,status_job_detail,EmployeeID,ID_order_screen,created_at,Sub_DepartmentID,job_status)
        SELECT JobID,DepartmentID,5,?,ID_order_screen,?,Sub_DepartmentID,2 FROM job_detail
        WHERE JobID = ? AND status_job_detail = '1' limit 1", [Auth::user()->id,now(),$id_job]);

        DB::update("UPDATE job SET job.status = '2' WHERE job.ID = ?", [$id_job]);
        DB::update("UPDATE order_screen SET order_screen.note = ? WHERE order_screen.ID  = ?", [$request->note,$id_order_screen]);
        DB::update("UPDATE job_detail SET  job_detail.job_status = '2', job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]);
        return redirect('/FQC'.'/'.$id);
    }


    // public function fqc_uncomplete($id,Request $request,$id_job){
    //     dd($id, $request,$id_job);
    //     DB::insert("INSERT INTO job_detail ()");
    //     DB::update("UPDATE job_detail SET job_detail.status_job_detail = '4' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]);
    //     DB::update("UPDATE job SET job.status = '2' WHERE job.ID = ?", [$id_job]);
    // }

    public function fqc_uncomplete($id,Request $request,$id_job){
        //////หา job_detail ปัจจุบัน  
                $job_detail = DB::select("SELECT
                job_detail.ID
                FROM
                job_detail
                WHERE
                job_detail.JobID = ? AND
                job_detail.DepartmentID = ?
                ORDER BY
                job_detail.ID DESC
                LIMIT 1
                ",[$id_job,$id]);
                // return  $job_detail[0]->ID;
        //////
        $count = count($request->checkbox);
        for ($i = 0; $i < $count; $i++) {
            for ($i = 0; $i < $count; $i++) {
                $Subdepartment = DB::select("SELECT qcchecklist.sub_department FROM qcchecklist WHERE qcchecklist.id = ?",[$request->checkbox[$i]]);
                // return $out_Subdepartment->sub_department;
                foreach ($Subdepartment as $out_Subdepartment) {
                    // $job_detail = DB::select("SELECT job_detail.ID FROM job_detail WHERE job_detail.Sub_DepartmentID = ? AND job_detail.status_job_detail = 4 AND JobID = ?",[$out_Subdepartment->sub_department,$id_job]);
                    // dd($id, $request,$id_job,$job_detail);
                    foreach($job_detail as $out_job_detail){
                        // return $out_job_detail->ID;
                        // $QC = DB::insert("INSERT INTO Job_QC (Job_ID,Job_detail_ID,QC_ID,Employee_ID,Type_QC,note,created_at,updated_at) VALUES (?,?,?,?,2,?,?,?)", [$id_job,$out_job_detail->ID,$request->checkbox[$i],Auth::user()->id,$request->note[$i],now(),now()]);
                        $QC = DB::insert("INSERT INTO Job_QC (Job_ID,Job_detail_ID,QC_ID,Employee_ID,Type_QC,note,created_at,updated_at) VALUES (?,?,?,?,2,?,?,?)", [$id_job,$out_job_detail->ID,$request->checkbox[$i],Auth::user()->id,$request->note[$i],now(),now()]);
                    }

                }
            }
            //
        }
        DB::update("UPDATE job_detail SET job_detail.status_job_detail = '4' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]);
        DB::update("UPDATE job SET job.status = '2' WHERE job.ID = ?", [$id_job]);

        return redirect('/FQC'.'/'.$id);
    }

    public function fqc_complete($id,$id_job){
        DB::update("UPDATE job SET job.date_time_finish = ? WHERE job.ID  = ?", [now(),$id_job]);
        DB::update("UPDATE job_detail SET job_detail.job_status = '2', job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]);
        DB::update("UPDATE job SET job.status = '2' WHERE job.ID = ?", [$id_job]);
        // DB::update("UPDATE job SET job.date_time_finish = ? WHERE job.ID  = ?", [now(),$id_job]);
        // DB::update("UPDATE job_detail SET job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]);

        return redirect('/FQC'.'/'.$id);
    }

    public function send_to_service($id,$id_job,Request $request){
        // return $request;
        $Subdepartment_id = null;
        $Subdepartment = null;
        $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?",[Auth::user()->id]);
        foreach($Subdepartment as $out_Subdepartment){
            $Subdepartment_id = $out_Subdepartment->Sub_DepartmentID;
        }
        $Department = DB::select("SELECT sub_department.ID,sub_department.DepartmentID FROM sub_department WHERE sub_department.ID =  ?",[$Subdepartment_id]);
        foreach($Department as $out_Department){
            $Department_id = $out_Department->DepartmentID;
        }

        //add service
        $order_screen = DB::select("SELECT job.ID_order_screen FROM job WHERE job.ID = ?",[$id_job]);
        if($order_screen != null ){
            $job = job::where('ID_order_screen', $order_screen[0]->ID_order_screen)->limit(1)->first();

                //6 รอติดต่อหมอ
                DB::update("UPDATE job SET job.job_current_department = 4 , job.status = 6 WHERE job.ID_order_screen  = ?", [$order_screen[0]->ID_order_screen]);

                $main_department = $id_job;
                DB::update("UPDATE job_detail SET job_detail.status_job_detail = '3'
                WHERE job_detail.JobID = ? AND job_detail.DepartmentID = ? AND job_detail.Sub_DepartmentID = ?"
                , [$job->ID,$main_department,24]);

                DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,EmployeeID,status_job_detail,
                created_at,DepartmentID,Sub_DepartmentID,job_status)
                VALUES (?,?,?,'6',now(),?,?,'6')", [$job->ID,$order_screen[0]->ID_order_screen,Auth::user()->id,4,10]);

                // update log service
                DB::update("UPDATE log_job_service SET log_job_service.status_job_detail = '4'
                WHERE log_job_service.JobID = ? AND log_job_service.DepartmentID = ? AND log_job_service.Sub_DepartmentID = ?"
                , [$job->ID,$id_job,10]);

                // insert log service status 2
                DB::insert("INSERT INTO log_job_service (JobID,status_job_detail,created_at,DepartmentID,Sub_DepartmentID, EmployeeID, Service_ID,Note_Service)
                VALUES (?,'2',now(),'4',?,?,?,?)", [$job->ID,10,$request->Service,$id_job,$request->NoteService]);
        }
        return redirect('/FQC'.'/'.$id);
    }

    public function call_to_doctor($id,$id_job,Request $request){
        DB::insert("INSERT INTO job_detail (JobID,DepartmentID,status_job_detail,EmployeeID,ID_order_screen,created_at,Sub_DepartmentID,Note_QC,Note_Service,job_status)
        SELECT JobID,4,7,?,ID_order_screen,?,10,'$request->noteQC','$request->noteService','2' FROM job_detail
        WHERE JobID = ? limit 1", [Auth::user()->id,now(),$id_job]); // 7 status บริการ ติดต่อหมอแล้ว / 4 department service /10 sub_depart service

        DB::insert("INSERT INTO log_job_service (JobID,DepartmentID,status_job_detail,Note_QC,Note_Service,created_at,Sub_DepartmentID)
        SELECT JobID,5,3,'$request->noteQC','$request->noteService',?,Sub_DepartmentID FROM job_detail
        WHERE JobID = ? AND status_job_detail = '1' limit 1", [now(),$id_job]);

        DB::update("UPDATE job SET job.status = 2 ,Note_QC = '$request->noteQC', Note_Service = '$request->noteService' WHERE job.ID = ? ", [$id_job]);

        DB::update("UPDATE job_detail SET  job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'" , [$id_job]);

        return redirect('/FQC'.'/'.$id);
    }
}
