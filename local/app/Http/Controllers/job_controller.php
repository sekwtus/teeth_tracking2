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
use App\users;
use App\screen_file;
use Gate;
use Redirect;
use Session;
use App\job_detail;
use DataTables;

class job_controller extends Controller
{
    public function getIndex($id_job)
    {
        // return Auth::user()->id;
        
        // $data_Employee = Employee::where('ID_user', Auth::user()->id)->limit(1)->first();
        // $data_department = department::where('ID', $data_Employee->department)->limit(1)->first();
        $name_department = department::where('ID', $id_job)->limit(1)->first();
        $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?", [Auth::user()->id]);

        if (Gate::allows('IsQC') || Gate::allows('IsFQC') || Gate::allows('IsAdmin')) {
            $Subdepartment = DB::select("SELECT
                            sub_department.ID as Sub_DepartmentID,
                            sub_department.DepartmentID,
                            sub_department.`Name`,
                            sub_department.created_at,
                            sub_department.updated_at,
                            sub_department.type_dep
                            FROM
                            sub_department
                            WHERE
                            sub_department.DepartmentID = $id_job AND
                            sub_department.type_dep IN ('qc')");
        }

        if (!Gate::allows('IsAdmin') && !Gate::allows('IsQC') &&  !Gate::allows('IsTechnician') && !Gate::allows('IsFQC')) {
            abort(404, "Page NotFound");
        }

        $data_job = job::select_job_current($id_job); //งานรับเข้าแผนกหลัก
        // $data_job_detail = job::select_job_detail_current($id_job);
        // $data_qc_checklist = job::select_qc_checklist($id_job);
        // $user_subDepartment= null;

        $id = $id_job;
        $select_data_job = job::select_job1($id_job);  // data qc
        // $select_data_job1 = job::select_job($id_job, $Subdepartment[0]->Sub_DepartmentID); //datasend doctor
        // $data_employee = job::select_employee_job();
        // $data_fqc_checklist = job::select_fqc_checklist($id,$id_job);

        // $data_department_all = DB::select("SELECT ID,Name FROM department WHERE id < 100");
        // $data_detailjob = job::select_detail_job();

        // $Sub_department_FQC = DB::select("SELECT
        //         qcchecklist.sub_department,
        //         qcchecklist.departmentID,
        //         sub_department.`Name`
        //         FROM
        //         qcchecklist
        //         INNER JOIN sub_department ON qcchecklist.sub_department = sub_department.ID
        //         WHERE
        //         qcchecklist.sub_department IN ((SELECT
        //         job_detail.Sub_DepartmentID
        //         FROM
        //         job_detail
        //         WHERE
        //         job_detail.status_job_detail = 1 AND
        //         job_detail.DepartmentID = '$id_job'))
        // LIMIT 1");


        // $Department_FQC = DB::select("SELECT
        // qcchecklist.sub_department,
        // sub_department.`Name`, 
        // department.`Name` as DepartmentName,
        // department.ID as DepartmentID
        // FROM
        // qcchecklist
        // INNER JOIN sub_department ON qcchecklist.sub_department = sub_department.ID
        // INNER JOIN department ON qcchecklist.departmentID = department.ID
        // WHERE
        // qcchecklist.sub_department IN ((
        // SELECT
        //     job_detail.Sub_DepartmentID 
        // FROM
        //     job_detail 
        // WHERE
        //     job_detail.status_job_detail = 1 
        //     AND job_detail.DepartmentID = '$id_job')) LIMIT 1");

        // $count = DB::select('SELECT
        //             Count(user_subDepartments.user_id) as count
        //             FROM
        //             user_subDepartments
        //             WHERE
        //             user_subDepartments.user_id = 0
        //             GROUP BY
        //             user_subDepartments.user_id');


        // $all_subDepartment = DB::select("SELECT
        //             Employee.Nick_name,
        //             Employee.name_position,
        //             Employee.department,
        //             Employee.ID,
        //             Employee.ID AS count_job,
        //             users.username,
        //             type_Branch.`Name` AS Branch,
        //             company.`Name` AS company
        //             FROM
        //             Employee
        //             LEFT JOIN users ON Employee.ID_user = users.id
        //             LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID
        //             LEFT JOIN company ON Employee.ID_company = company.ID
        //             WHERE
        //             Employee.department = '$id_job' AND
        //             Employee.`status` = 1
        //             GROUP BY
        //             Employee.ID
        //             ");

        // $note = DB::select("SELECT
        //             job_detail.ID_order_screen,
        //             order_screen.ID,
        //             order_screen.note,
        //             job_detail.DepartmentID,
        //             order_screen.Barcode
        //             FROM
        //             order_screen
        //             INNER JOIN job_detail ON job_detail.ID_order_screen = order_screen.ID
        //             WHERE
        //             job_detail.DepartmentID = '$id_job'
        //             GROUP BY
        //             job_detail.ID_order_screen
        //             ");

        // $all_department = DB::select("SELECT
        //     department.ID,
        //     department.`Name`
        //     FROM
        //     department
        //     where
        //     department.ID > 0 and department.ID < 100 ");

        // $Service = DB::select('SELECT
        //     Employee.ID,
        //     Employee.Nick_name
        //     FROM
        //     Employee
        //     WHERE
        //     Employee.department = 4');



        return view('Job.job_main', compact(
            // 'all_subDepartment',
            'data_job',
            // 'data_qc_checklist',
            // 'count',
            'select_data_job',
            'id',
            'id_job',
            // 'note',
            // 'select_data_job1',
            // 'Sub_department_FQC',
            'name_department'
            // 'all_department',
            // 'Service',
            // 'Department_FQC'
        ));
    }

    public function ajax_get_data_job(Request $request)
    {
        $data_job = job::select_job_current($request->id_job);
        return Datatables::of($data_job)->addIndexColumn()->make(true);
    }

    public function ajax_get_type_product(Request $request)
    {

        if (
            empty(order_screen::where('barcode', $request->barcode)->limit(1)->first()) ||  //ไม่มีbarcode
            !empty(users::where('username', $request->scanbarcode_pd)->where('ID_type_users', 2)->limit(1)->first())
        ) { //มีbarcode แต่เป็นเซล
            // Session::flash('message', "ไม่มีบาร์โค๊ดพนักงาน  ".$request->usercode);
            return 'บาร์โค้ดไม่ถูกต้อง';
        }
        $type_product = DB::select("SELECT
                            order_teeth_screen.OrderID,
                            order_teeth_screen.TypeOfProductID,
                            order_screen.Barcode,
                            type_of_product.`Name` AS product_name,
                            count(order_teeth_screen.TeethID) as count
                            FROM
                            order_teeth_screen
                            LEFT JOIN order_screen ON order_teeth_screen.OrderID = order_screen.ID
                            LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
                            WHERE
                            order_screen.Barcode = '$request->barcode'
                            GROUP BY order_teeth_screen.TypeOfProductID ");
        return $type_product;
    }

    public function req_employee_dept(Request $request)
    {
        if (
            empty(users::where('username', $request->scanbarcode_pd)->limit(1)->first()) ||  //ไม่มีbarcode
            !empty(users::where('username', $request->scanbarcode_pd)->where('ID_type_users', 2)->limit(1)->first())
        ) { //มีbarcode แต่เป็นเซล
            // Session::flash('message', "ไม่มีบาร์โค๊ดพนักงาน  ".$request->usercode);
            return 'บาร์โค้ดไม่ถูกต้อง';
        } else {
            $user_subDepartment = DB::select("SELECT
                user_subDepartments.ID,
                user_subDepartments.user_id,
                user_subDepartments.Sub_DepartmentID,
                user_subDepartments.created_at,
                sub_department.`Name`,
                Employee.Nick_name,
                sub_department.type_dep
                FROM
                user_subDepartments
                INNER JOIN users ON user_subDepartments.user_id = users.id
                LEFT JOIN sub_department ON user_subDepartments.Sub_DepartmentID = sub_department.ID
                LEFT JOIN Employee ON user_subDepartments.user_id = Employee.ID_user
                WHERE
                users.username = '$request->scanbarcode_pd'");

            $subDepartment_NotinUser = DB::select("SELECT
                sub_department.ID as Sub_DepartmentID,
                sub_department.DepartmentID,
                sub_department.`Name`,
                sub_department.type_dep
                FROM
                sub_department
                WHERE
                sub_department.ID not IN (SELECT
                user_subDepartments.Sub_DepartmentID
                FROM
                user_subDepartments
                INNER JOIN sub_department ON user_subDepartments.Sub_DepartmentID = sub_department.ID
                INNER JOIN users ON user_subDepartments.user_id = users.id
                WHERE
                users.username = '$request->scanbarcode_pd'
                ) and sub_department.DepartmentID = '$request->id_department'
                AND sub_department.type_dep IS NULL");

            return  array($user_subDepartment, $subDepartment_NotinUser);
        }
    }

    public function add_job($id_job, Request $request)
    {
        // return $id_job;
        $count = count($request->Barcode);
        $message_alert_Nobarcode = null;
        

        for ($i = 0; $i < $count; $i++) {
            $Barcode_DB = DB::select("SELECT order_screen.ID,order_screen.Barcode FROM  order_screen where Barcode =  ?", [$request->Barcode[$i]]);
            if ($Barcode_DB != null) { //ต้องมีbarcode
                $check_inRule = job::where('ID_order_screen', $Barcode_DB[0]->ID)->limit(1)->first();
                if (
                    $check_inRule->job_current_department == 0 || $check_inRule->status == 2 ||
                    $check_inRule->status == 4 ||  $check_inRule->status == 5 ||  $check_inRule->status == 7
                ) {
                    //0->screenแล้ว   2->QC เสร็จ  4->ส่งต่อให้หมอ 5->ส่งต่อให้บริการ   7->บริการ ติดต่อหมอแล้ว ==> สามารถเข้าแผนกหลัก

                    $screen = order_screen::where('Barcode', $request->Barcode[$i])->limit(1)->first();
                    job::update_job_detail($id_job, $screen->ID);
                    DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,EmployeeID,status_job_detail,created_at,DepartmentID,job_status)
                    VALUES (?,?,?,'0',now(),?,NULL)", [$check_inRule->ID, $Barcode_DB[0]->ID, Auth::user()->id, $id_job]); //add เข้าแผนกหลัก ให้เก็บข้อมูลเพื่อแสดงในsummary report
                } else {
                    $message_alert_Nobarcode = $message_alert_Nobarcode .'        ตรวจสอบว่า[' . $request->Barcode[$i].'] อยู่แผนก หรือ อยู่ในแผนกอื่นแล้ว';
                }
            } elseif ($request->Barcode[$i] != null && $request->Barcode[$i] != '') {
                $message_alert_Nobarcode = $message_alert_Nobarcode  .'       ไม่พบ[' . $request->Barcode[$i].']';
            }
        }

        if (!empty($message_alert_Nobarcode)) {
            Session::flash('message', "ไม่สามารถเพิ่มบาร์โค๊ด " . $message_alert_Nobarcode );
        }

        return redirect('/job' . '/' . $id_job);
    }

    public function add_sub_department($id_job, Request $request)
    {

        $count = count($request->job);
       
        $message_alert_Nobarcode = '';
        
        for ($i = 0; $i < $count; $i++) {
            if ($request->job[$i]) {
                $order_screen = order_screen::where('Barcode', $request->job[$i])->limit(1)->first();

                if ($order_screen != null) {
                    $job = job::where('ID_order_screen', $order_screen->ID)->limit(1)->first();
                    // if($check_inRule->job_current_department == $id_job){
                    if ($job->job_current_department == $id_job && ($job->status == null ||  $job->status == 1)) {
                        //่job = check_inRule   !=0->เข้าแผนกหลัก  null->เข้าแผนกหลัก  ->1แผนกย่อย
                        
                        if($request->sub_depart != null){
                        
                            $count_sub = count($request->sub_depart);
                        
                        for ($j = 0; $j < $count_sub; $j++) {
                            job::update_job_detail_status($job->ID);
                            job::update_job($job->ID, $id_job, $request->sub_depart[$j]);
                            job::insert_job($job->ID, $order_screen->ID, $request->EmployeeID, $id_job, $request->sub_depart[$j]);

                            // unit
                            $select_teeth = DB::select("SELECT
                                                order_teeth_screen.ID,
                                                order_teeth_screen.TypeOfProductID,
                                                order_teeth_screen.TypeOfWorkID,
                                                order_teeth_screen.TypeOfGroupID
                                                FROM
                                                order_teeth_screen
                                                WHERE
                                                order_teeth_screen.OrderID = '$order_screen->ID'");
                            foreach ($select_teeth as $key => $value) {
                                DB::insert(
                                    "INSERT into unit_employee(sub_depart,EmployeeID,barcode,typeProduct,teeth_id,created_at,typeWork,typeGroup)
                                        value(?,?,?,?,?,?,?,?)",
                                    [$request->sub_depart[$j], $request->EmployeeID, $request->job[$i], $value->TypeOfProductID, $value->ID, now(), $value->TypeOfWorkID, $value->TypeOfGroupID]
                                );
                            }
                        }
                    }else{

                        $message_alert_Nobarcode = $message_alert_Nobarcode . 'ไม่ได้เลือก แผนกย่อย';

                      } // end check sub depatment 
                    } else {
                        $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
                    } // end check status job
                } else {
                    $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
                }
            }
        }

        if ($message_alert_Nobarcode != '' && $message_alert_Nobarcode != null) {
            Session::flash('message', "กรุณารับงาน บาร์โค๊ด " . $message_alert_Nobarcode . " เข้าแผนกก่อน");
        }

        //////////////////////save file
        $tf = new screen_file();
        if($request->hasFile('txtFile')) {
            $filename = $request->job[0].'_'.$request->file('txtFile')->getClientOriginalName();
            $request->file('txtFile')->move(public_path("file"), $filename);
            $tf->name_file = $filename;
            $tf->barcode = $request->job[0];
            $tf->type = '2';
            $tf->screen_id = $order_screen->ID;
            $tf->save();
        }
        

        return redirect('/distribute_job' . '/' . $id_job);
    }

    public function add_sub_department2($id_job, Request $request)
    {

        $count = count($request->job2);
        $message_alert_Nobarcode = '';

        for ($i = 0; $i < $count; $i++) {
            if ($request->job2[$i]) {
                $order_screen = order_screen::where('Barcode', $request->job2[$i])->limit(1)->first();

                if ($order_screen != null) {
                    $job = job::where('ID_order_screen', $order_screen->ID)->limit(1)->first();
                    // if($check_inRule->job_current_department == $id_job){
                    if ($job->job_current_department == $id_job && ($job->status == null ||  $job->status == 1)) {
                        //่job = check_inRule   !=0->เข้าแผนกหลัก  null->เข้าแผนกหลัก  ->1แผนกย่อย
                        $count_sub = count($request->sub_depart);
                        $count_product = count($request->typeProduct);
                        for ($j = 0; $j < $count_sub; $j++) {
                            job::update_job_detail_status($job->ID);
                            job::update_job($job->ID, $id_job, $request->sub_depart[$j]);
                            job::insert_job($job->ID, $order_screen->ID, $request->EmployeeID, $id_job, $request->sub_depart[$j]);
                            for ($k = 0; $k < $count_product; $k++) {
                                $select_teeth = DB::select("SELECT
                                                order_teeth_screen.ID,
                                                order_teeth_screen.TypeOfWorkID,
                                                order_teeth_screen.TypeOfGroupID
                                                FROM
                                                order_teeth_screen
                                                WHERE
                                                order_teeth_screen.OrderID = '$request->OrderID' AND
                                                order_teeth_screen.TypeOfProductID = ? ", [$request->typeProduct[$k]]);
                                foreach ($select_teeth as $key => $value) {
                                    DB::insert(
                                        "INSERT into unit_employee(sub_depart,EmployeeID,barcode,typeProduct,teeth_id,created_at,typeWork,typeGroup)
                                        value(?,?,?,?,?,?,?,?)",
                                        [$request->sub_depart[$j], $request->EmployeeID, $request->job2[0], $request->typeProduct[$k], $value->ID, now(), $value->TypeOfWorkID, $value->TypeOfGroupID]
                                    );
                                }
                            }
                        }
                    } else {
                        $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job2[$i];
                    }
                } else {
                    $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job2[$i];
                }
            }
        }

        if ($message_alert_Nobarcode != '' && $message_alert_Nobarcode != null) {
            Session::flash('message', "กรุณารับงาน บาร์โค๊ด" . $message_alert_Nobarcode . "เข้าแผนกก่อน");
        }

        return redirect('/distribute_job' . '/' . $id_job);
    }

    public function add_QC($id_job, Request $request)
    {
        $count = count($request->job);
        $message_alert_Nobarcode = '';

        for ($i = 0; $i < $count; $i++) {
            $Subdepartment = null;
            $Department = null;
            $order_screen = DB::select("SELECT order_screen.ID,order_screen.Barcode FROM order_screen where Barcode = ?", [$request->job[$i]]);

            if ($order_screen != null) {
                $check_inRule = job::where('ID_order_screen', $order_screen[0]->ID)
                    ->join('department', 'job.job_current_department', '=', 'department.ID')->limit(1)->first();

                if ($check_inRule->job_current_department == $id_job) {
                    if ($check_inRule->status == 1) {
                        // 2->QCเสร็จ ผ่านกรณีqcอีกรอบ 1-> แผนกย่อย
                        $job = DB::select("SELECT order_screen.Barcode, job.ID FROM job INNER JOIN order_screen ON job.ID_order_screen = order_screen.ID where order_screen.Barcode = ?", [$request->job[$i]]);

                        $Subdepartment = DB::select("SELECT
                        sub_department.ID as Sub_DepartmentID,
                        sub_department.DepartmentID,
                        sub_department.`Name`,
                        sub_department.created_at,
                        sub_department.updated_at,
                        sub_department.type_dep
                        FROM
                        sub_department
                        WHERE
                        sub_department.DepartmentID = $id_job AND
                        sub_department.type_dep IN ('qc')");

                        DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,EmployeeID,status_job_detail,created_at,DepartmentID,Sub_DepartmentID,job_status)
                        VALUES (?,?,?,'1',now(),?,?,'3')", [$job[0]->ID, $order_screen[0]->ID, Auth::user()->id, $Subdepartment[0]->DepartmentID, $Subdepartment[0]->Sub_DepartmentID]);

                        DB::update("UPDATE job SET job.status = '3',job.job_current_department = ? WHERE job.ID = ?", [$Subdepartment[0]->DepartmentID, $job[0]->ID]);
                    } else {
                        $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
                    }
                } else {
                    Session::flash('message', "กรุณา QC บาร์โค๊ด " . $request->job[$i] . " ในแผนก " . $check_inRule->Name . "");
                    return redirect('/qc_job' . '/' . $id_job);
                }
            } else {
                $message_alert_Nobarcode = $message_alert_Nobarcode . '    ' . $request->job[$i];
            }
        }

        $string = str_replace(' ', '', $message_alert_Nobarcode);
        if (empty($string)) {
            return redirect('/qc_job' . '/' . $id_job);
        } else {
            Session::flash('message', "ไม่สามารถเพิ่มบาร์โค๊ด" . $message_alert_Nobarcode . " ได้");
        }
        return redirect('/qc_job' . '/' . $id_job);
    }

    public function send_to_doctor($id, Request $request)
    {
        // เพิ่ม Job Detail ให้สามารถแสดงว่ากำลังส่งให้หมอ
        // DB::insert("INSERT INTO job_detail (JobID,DepartmentID,status_job_detail,EmployeeID,ID_order_screen,created_at,Sub_DepartmentID)
        // SELECT JobID,DepartmentID,5,?,ID_order_screen,?,Sub_DepartmentID FROM job_detail
        // WHERE JobID = ? AND job_detail.status_job_detail = '1' ORDER BY job_detail.ID DESC limit 1", [Auth::user()->id,now(),$id_job]);

        DB::update("UPDATE order_screen SET order_screen.note = ? WHERE order_screen.ID  = ?", [$request->note, $request->id_order_screen]);

        DB::update("UPDATE job SET job.status = '4' WHERE job.ID = ?", [$request->JobID]);
        
        DB::update("UPDATE job_detail SET job_detail.job_status = '4', job_detail.status_job_detail = '5' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1' AND  job_detail.job_status = '3'", [$request->JobID]);
        DB::update("UPDATE job_detail SET  job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$request->JobID]);

        return redirect('/qc_job' . '/' . $id);
    }

    public function qc_uncomplete($id, Request $request, $id_job)
    {
        $job_detail_id = [];
        $count = count($request->checkbox);

        $qccheck_id = join("','", $request->checkbox);
        $Subdepartment = DB::select("SELECT qcchecklist.sub_department FROM qcchecklist WHERE qcchecklist.id IN ('$qccheck_id')", []);

        for ($i = 0; $i < $count; $i++) {
            $job_detail = DB::select("SELECT job_detail.ID FROM job_detail WHERE job_detail.Sub_DepartmentID = ? AND job_detail.status_job_detail = 1 AND JobID = ?", [$Subdepartment[$i]->sub_department, $id_job]);
            foreach ($job_detail as $out_job_detail) {
                DB::insert("INSERT INTO Job_QC (Job_ID,Job_detail_ID,QC_ID,Employee_ID,Type_QC,note,created_at,updated_at) VALUES (?,?,?,?,1,?,?,?)", [$id_job, $out_job_detail->ID, $request->checkbox[$i], Auth::user()->id, $request->note[$i], now(), now()]);
                $job_detail_id[] = $out_job_detail->ID;
            }
        }
        if (!empty($job_detail_id)) {
            for ($j = 0; $j < count($job_detail_id); $j++) {
                DB::update("UPDATE job_detail SET job_detail.job_status = '1', job_detail.status_job_detail = '4' WHERE ID = '$job_detail_id[$j]' and job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]);
            }
        }

        DB::update("UPDATE job_detail SET job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1' AND job_detail.job_status = '1'", [$id_job]);
        DB::update("UPDATE job_detail SET job_detail.job_status = '2', job_detail.status_job_detail = '4' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1' AND job_detail.job_status = '3'", [$id_job]);
        DB::update("UPDATE job SET job.status = null WHERE job.ID = ?", [$id_job]);
        return redirect('/qc_job' . '/' . $id);
    }

    public function qc_complete($id, $id_job)
    {
        // DB::update("UPDATE job SET job.date_time_finish = ? WHERE job.ID  = ?", [now(),$id_job]);
        DB::update("UPDATE job_detail SET job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]); //1s
        DB::update("UPDATE job_detail SET job_detail.job_status = '2' WHERE job_detail.JobID = ? AND job_detail.job_status = '3'", [$id_job]); //1s
        DB::update("UPDATE job SET job.status = '2' WHERE job.ID = ?", [$id_job]); //0.015s
        return redirect('/qc_job' . '/' . $id);
    }

    public function getExport($id_job)
    {

        $data_Employee = Employee::where('ID_user', Auth::user()->id)->limit(1)->first();
        $data_department = department::where('ID', $data_Employee->department)->limit(1)->first();
        if ($data_Employee->department != $id_job && !Gate::allows('IsAdmin') && !Gate::allows('IsSale')) {
            abort(404, "Page NotFound");
        }

        $data_job = job::select_job_current($id_job);
        $data_job_detail = job::select_job_detail_current($id_job);
        $data_qc_checklist = job::select_qc_checklist($id_job);
        $user_subDepartment = null;


        $id = $id_job;
        $select_data_job = job::select_job1($id_job);
        $data_employee = job::select_employee_job();
        $data_fqc_checklist = job::select_fqc_checklist($id, $id_job);

        $data_department_all = DB::select("SELECT ID,Name FROM department WHERE id < 100");
        $data_detailjob = job::select_detail_job();
        // $data_employee = job::select_employee_job();
        // $data_fqc_checklist = job::select_fqc_checklist($id,$id_job);

        $count = DB::select('SELECT
                        Count(user_subDepartments.user_id) as count
                        FROM
                        user_subDepartments
                        WHERE
                        user_subDepartments.user_id = 0
                        GROUP BY
                        user_subDepartments.user_id');


        $all_subDepartment = DB::select("SELECT
                        Employee.Nick_name,
                        Employee.name_position,
                        Employee.department,
                        Employee.ID,
                        Count(job_detail.Sub_DepartmentID) AS count_job,
                        users.username
                        FROM
                        Employee
                        LEFT JOIN job_detail ON Employee.ID = job_detail.EmployeeID AND DATE(job_detail.created_at) = CURDATE()
                        LEFT JOIN users ON Employee.ID_user = users.id
                        WHERE
                        Employee.department = '$id_job'
                        GROUP BY
                        Employee.ID
                        ");

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

        return view('job.Export', compact('detail_emp_Do_subDepartment', 'all_subDepartment', 'data_job', 'data_job_detail', 'data_qc_checklist', 'data_department', 'count', 'user_subDepartment', 'select_data_job', 'data_employee', 'data_fqc_checklist', 'id', 'id_job', 'data_department_all', 'note'));

        // return $data_job_detail;
    }

    public function send_to_service($id, $id_job, Request $request)
    {
        // return $request->Service;
        $Subdepartment_id = null;
        $Subdepartment = null;
        $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?", [Auth::user()->id]);
        foreach ($Subdepartment as $out_Subdepartment) {
            $Subdepartment_id = $out_Subdepartment->Sub_DepartmentID;
        }
        $Department = DB::select("SELECT sub_department.ID,sub_department.DepartmentID FROM sub_department WHERE sub_department.ID =  ?", [$Subdepartment_id]);
        foreach ($Department as $out_Department) {
            $Department_id = $out_Department->DepartmentID;
        }

        $now = \Carbon\Carbon::now();
        DB::update("UPDATE job SET date_time_start = '$now' , job.status = '5', Note_QC = ?,Service_ID = ? WHERE job.ID = ?", [$request->NoteService, $request->Service, $id_job]);
        DB::insert("INSERT INTO log_job_service (JobID, DepartmentID, status_job_detail, Note_QC, created_at, Sub_DepartmentID, EmployeeID,Service_ID)
        SELECT JobID, ?, 1, ?,  ?, ?,?,? FROM job_detail
        WHERE JobID = ? AND status_job_detail = '1' limit 1", [$Department_id, $request->NoteService, now(), $Subdepartment_id, Auth::user()->id, $request->Service, $id_job]);

        //add service
        $order_screen = DB::select("SELECT order_screen.ID,order_screen.Barcode FROM order_screen where Barcode = ?", [$request->Barcode]);
        // $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?",[Auth::user()->id]);
        if ($order_screen != null) {
            $job = job::where('ID_order_screen', $order_screen[0]->ID)->limit(1)->first();

            //6 รอติดต่อหมอ
            DB::update("UPDATE job SET job.job_current_department = 4 , job.status = 6 WHERE job.ID_order_screen  = ?", [$order_screen[0]->ID]);
            DB::update("UPDATE job_detail SET job_detail.job_status = '2' WHERE job_detail.JobID = ? AND job_detail.job_status = '3'", [$id_job]);
            $main_department = $id_job;
            DB::update(
                "UPDATE job_detail SET job_detail.status_job_detail = '2'
                WHERE job_detail.JobID = ? AND job_detail.DepartmentID = ? AND job_detail.Sub_DepartmentID = ?",
                [$job->ID, $main_department, 10]
            );

            DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,EmployeeID,status_job_detail,
                created_at,DepartmentID,Sub_DepartmentID,job_status,Note_QC)
                VALUES (?,?,?,'6',now(),?,?,'6',?)", [$job->ID, $order_screen[0]->ID, Auth::user()->id, 4, 10, $request->NoteService]);

            // update log service
            DB::update(
                "UPDATE log_job_service SET log_job_service.status_job_detail = '4'
                WHERE log_job_service.JobID = ? AND log_job_service.DepartmentID = ? AND log_job_service.Sub_DepartmentID = ?",
                [$job->ID, $id_job, 10]
            );

            // insert log service status 2
            DB::insert("INSERT INTO log_job_service (JobID,status_job_detail,created_at,DepartmentID,Sub_DepartmentID,Service_ID)
                VALUES (?,'2',now(),'4',?,?)", [$job->ID, 10, $request->Service]);
        }
        return redirect('/qc_job' . '/' . $id);
    }

    public function QC_Uncom_backward($id, $id_job, Request $request)
    {
        $department = job_detail::where('job_detail.JobID', $id_job)
            ->where('job_detail.DepartmentID', $request->checkboxcombackward)
            ->where('job_detail.status_job_detail', '3')
            ->limit(1)->first();

            if (!empty($department)) {
            $now = \Carbon\Carbon::now();

            $job_detail = DB::select("SELECT
            job_detail.*
            FROM
            job_detail
            WHERE
            job_detail.JobID = ? AND
            job_detail.DepartmentID = ?
            ORDER BY
            job_detail.ID DESC
            ",[$id_job,$id]);

            DB::insert("INSERT INTO Job_QC (Job_ID,ToDepartmentID,Employee_ID,Type_QC,note,created_at,updated_at,QC_ID,Job_detail_ID) VALUES (?,?,?,1,?,?,?,?,?)", [$id_job, $request->checkboxcombackward, Auth::user()->id, $request->notebackward, now(), now(),$request->checkbox[0],$job_detail[0]->ID]);
           
            
            // ไม่ auto รับเข้าแผนก ต้องมีการยิงเข้าอีกครั้ง 
            DB::update("UPDATE job SET date_time_start = '$now' , job.status = null ,job.job_current_department = null WHERE job.ID = ?", [$id_job]); 
          
            DB::update("UPDATE job_detail SET job_detail.job_status = '2', job_detail.status_job_detail = '4' ,job_detail.detail_job = ? WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1' AND job_detail.job_status = '3'", [$request->checkboxcombackward,$id_job]);  // ตีกลับเฉพาะแผนกที่ระบุ

            DB::update("UPDATE order_screen SET order_screen.job_current_department = '$id' WHERE order_screen.ID = '?' ", [$job_detail[0]->ID_order_screen]);  // update แผนกปัจจุบัน 
            
        } else {
            Session::flash('message', "ไม่สามารถตีกลับแผนกที่ไม่เคยผ่านได้");
        }
        
        return redirect('/job' . '/' . $id);
     }

    public function call_to_doctor($id, $id_job, Request $request)
    {
        DB::insert("INSERT INTO job_detail (JobID,DepartmentID,status_job_detail,EmployeeID,ID_order_screen,created_at,Sub_DepartmentID,Note_QC,Note_Service,job_status)
        SELECT JobID,4,7,?,ID_order_screen,?,10,'$request->noteQC','$request->noteService','2' FROM job_detail
        WHERE JobID = ? limit 1", [Auth::user()->id, now(), $id_job]); // 7 status บริการ ติดต่อหมอแล้ว / 4 department service /10 sub_depart service

        DB::insert("INSERT INTO log_job_service (JobID,DepartmentID,status_job_detail,Note_QC,Note_Service,created_at,Sub_DepartmentID)
        SELECT JobID, 5,3,'$request->noteQC','$request->noteService',?,Sub_DepartmentID FROM job_detail
        WHERE JobID = ? AND status_job_detail = '1' limit 1", [now(), $id_job]);

        DB::update("UPDATE job SET job.status = 4 ,Note_QC = '$request->noteQC', Note_Service = '$request->noteService' WHERE job.ID = ? ", [$id_job]);

        DB::update("UPDATE job_detail SET  job_detail.status_job_detail = '3' WHERE job_detail.JobID = ? AND job_detail.status_job_detail = '1'", [$id_job]);

        return redirect('/qc_job' . '/' . $id);
    }

    public function getdistributeIndex($id_job)
    {
        $name_department = department::where('ID', $id_job)->limit(1)->first();
        $count = DB::select('SELECT
                    Count(user_subDepartments.user_id) as count
                    FROM
                    user_subDepartments
                    WHERE
                    user_subDepartments.user_id = 0
                    GROUP BY
                    user_subDepartments.user_id');

        $all_subDepartment = DB::select("SELECT
                    Employee.Nick_name,
                    Employee.name_position,
                    Employee.department,
                    Employee.ID,
                    Employee.ID AS count_job,
                    users.username,
                    type_Branch.`Name` AS Branch,
                    company.`Name` AS company
                    FROM
                    Employee
                    LEFT JOIN users ON Employee.ID_user = users.id
                    LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID
                    LEFT JOIN company ON Employee.ID_company = company.ID
                    WHERE
                    Employee.department = '$id_job' AND
                    Employee.`status` = 1
                    GROUP BY
                    Employee.ID
                    ");

        return view('Job.job_distribute', compact(
            'all_subDepartment',
            'count',
            'id_job',
            'name_department'
        ));
    }

    public function getQCIndex($id_job)
    {  
        $name_department = department::where('ID', $id_job)->limit(1)->first();
        $Subdepartment = DB::select("SELECT user_subDepartments.Sub_DepartmentID  FROM user_subDepartments  WHERE user_id = ?", [Auth::user()->id]);
        if (Gate::allows('IsQC') || Gate::allows('IsFQC') || Gate::allows('IsAdmin')) {
            $Subdepartment = DB::select("SELECT
                            sub_department.ID as Sub_DepartmentID,
                            sub_department.DepartmentID,
                            sub_department.`Name`,
                            sub_department.created_at,
                            sub_department.updated_at,
                            sub_department.type_dep
                            FROM
                            sub_department
                            WHERE
                            sub_department.DepartmentID = $id_job AND
                            sub_department.type_dep IN ('qc')");  //0.14s
        }

        if (!Gate::allows('IsAdmin') && !Gate::allows('IsQC') &&  !Gate::allows('IsTechnician') && !Gate::allows('IsFQC')) {
            abort(404, "Page NotFound");
        }

        // $data_job = job::select_job_current($id_job); //งานรับเข้าแผนกหลัก
        $data_qc_checklist = job::select_qc_checklist($id_job);

        $id = $id_job;
        $select_data_job = job::select_job1($id_job);  // data qc
        ////// หาวันที่ล่าสุด
        
        $select_job_detail = job::select_job_detail($id_job, $Subdepartment[0]->Sub_DepartmentID); 
        if($select_job_detail == null){
            $job_detail_created_at = job::select_job_detail_created_at($id_job, $Subdepartment[0]->Sub_DepartmentID,' ') ;
        }
        else {
            $job_detail_created_at = job::select_job_detail_created_at($id_job, $Subdepartment[0]->Sub_DepartmentID, $select_job_detail[0]->ID) ;
        }
        //////
        $select_data_job1 = job::select_job_qc($id_job, $Subdepartment[0]->Sub_DepartmentID,$job_detail_created_at[0]->created_at); //datasend doctor
         
        $Sub_department_FQC = DB::select("SELECT
        sub_department.ID,
        sub_department.`Name`,
        department.ID as departmentID
        FROM
        department
        INNER JOIN sub_department ON department.ID = sub_department.DepartmentID
        WHERE
        department.ID = '$id_job'");

        $Department_FQC = DB::select("SELECT
        department.`Name` AS DepartmentName,
        department.ID AS DepartmentID
        FROM
        department
        WHERE
        department.ID = '$id_job'");

        $all_department = DB::select("SELECT
            department.ID,
            department.`Name`
            FROM
            department
            where
            department.ID > 0 and department.ID < 100 ");

        $Service = DB::select('SELECT
            Employee.ID,
            Employee.Nick_name
            FROM
            Employee
            WHERE
            Employee.department = 4');

        ///////////////////////////

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

            $Job_ID = array();
            $fqc_checklist = array();
            $data_fqc_checklist = null;


            foreach ($select_data_job as $out_select_data_job){
                $Job_ID[] = $out_select_data_job->ID;
            }
               
            // $count = count($Job_ID);  

            // for ($i = 0; $i < $count; $i++) {
                $fqc_checklist[] = job::select_fqc_checklist(1);
            // }

            if(!empty($fqc_checklist) ){
                $data_fqc_checklist = $fqc_checklist[0];
            }


        return view('Job.job_qc', compact(
            // 'data_job',
            'data_qc_checklist',
            'select_data_job',
            'id',
            'id_job',
            'select_data_job1',
            'Sub_department_FQC',
            'name_department',
            'all_department',
            'Service',
            'Department_FQC',
            'Sub_department_FQC',
            'data_fqc_checklist'
        ));
    }

    public function ajax_get_note(Request $req) {
        $note = DB::select("SELECT
        job_detail.ID_order_screen,
        order_screen.ID,
        order_screen.note,
        job_detail.DepartmentID,
        order_screen.Barcode,
        job_detail.JobID
        FROM
        order_screen
        INNER JOIN job_detail ON job_detail.ID_order_screen = order_screen.ID
        WHERE
        job_detail.JobID = ?
        GROUP BY
        job_detail.ID_order_screen",[$req->id]);
        return $note;
    }
    //////////////////save file

    
}
