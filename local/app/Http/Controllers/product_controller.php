<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Gate;
use DB;
use App\order_sale;
use App\job;
use App\job_detail;
use App\order_screen;

class product_controller extends Controller
{


    public function getIndex($id,Request $request){
        // if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
        //     abort(404,"Page NotFound");
        // }
        $ID_user = Auth::user()->id;
        $data_user = DB::select("SELECT department FROM Employee WHERE ID_user= ?",[$ID_user]);

        foreach($data_user as $out_data_user){
            $department = $out_data_user->department;
        }

        if($department != $id && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        $data_department = DB::select("SELECT name FROM department WHERE id= ?",[$department]);
        // return $data_department;

        // if($id == '9' && $department != '23'){
        //     abort(404,"Page NotFound");
        // }
            $id_job = $id;
            $data_job = job::select_job1($id_job);
            $data_qc_checklist = job::select_qc_checklist($id_job);
            $data_detailjob = job::select_detail_job();
            $data_employee = job::select_employee_job();
            $data_fqc_checklist = job::select_fqc_checklist($id,$id_job);

        return view('Production.product1',compact('data_job','data_detailjob','data_employee','id_job','data_qc_checklist','data_fqc_checklist','id','data_department'));
        // return $data_qc_checklist;
    }

    public function getselect($id_job,$id){
        // if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
        //     abort(404,"Page NotFound");
        // }

            $data_job = job::select_job1($id_job);
            $data_qc_checklist = job::select_qc_checklist($id_job);
            $data_detailjob = job::select_detail_job_id($id,$id_job);
            $data_sale = job::select_sale_job_id($id);
            $data_employee = job::select_employee_job();
            $data_fqc_checklist = job::select_fqc_checklist($id_job,$id);


            /*ดึงเอาtypeuserไปแสดง*/
            $ID_user = Auth::user()->id;
            $data_user = DB::select("SELECT department FROM Employee WHERE ID_user= ?",[$ID_user]);
            foreach($data_user as $out_data_user){
                $department = $out_data_user->department;
            }
            /*----End----*/

            /*ดึงเอาแผนกuserไปแสดง*/
            $data_department = DB::select("SELECT name FROM department WHERE id= ?",[$department]);

            /*----End----*/
            $data_department_all = DB::select("SELECT ID,Name FROM department WHERE id < 100");

        return view('Production.product1',compact('data_job','data_detailjob','data_employee','id_job','data_qc_checklist','data_fqc_checklist','id','data_department','data_department_all','data_sale'));
        // return $data_qc_checklist;
    }

    public function addJob($id_job,Request $request){
        // if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
        //     abort(404,"Page NotFound");
        // }

        // $scanbarcode_pd = $request->scanbarcode_pd;
        $Barcode_DB = DB::select("SELECT order_sale.Barcode FROM  order_sale where Barcode =  ?",[$request->scanbarcode_pd]);
        if($Barcode_DB != null ){
            $data_id = order_screen::where('Barcode',$request->scanbarcode_pd)->limit(1)->first();
            $scanbarcode_pd = $data_id->ID;

            $id_job_current_department = $id_job;

            job::update_job_detail($id_job_current_department,$scanbarcode_pd);
            job::insert_job_detail($id_job_current_department,$scanbarcode_pd);

            return redirect('/product'.'/'.$id_job);
        }else{
            return redirect('/product'.'/'.$id_job)->with('massage','ไม่มี Barcode นี้ในระบบ');
        }


    }

    public function Openjob($id_job,Request $request,$id,$jobid,$detailid){
        // if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
        //     abort(404,"Page NotFound");
        // }

        $scanbarcode_pd = $request->scanbarcode_pd;
        $id_job_current_department = $id_job;

        $user = DB::select ("SELECT
        id
        FROM
        users
        where
        username = ? ",[$scanbarcode_pd]);
        $users_id = 0;
        foreach($user as $users){
            $users_id = $users->id;
        }
        if($user != null){
            job::insert_Openjob($id_job_current_department,$users_id,$jobid,$id,$detailid);
        }else{
            return redirect('/product'.'/'.$id_job.'/'.$jobid)/*->with('massage','ไม่มี User นี้ในระบบ')*/;
        }

        return redirect('/product'.'/'.$id_job.'/'.$jobid)/*->with('massage','การสแกนบาร์โค้ดรับงานสำเร็จ')*/;
        // return $id;
    }

    public function Closejob($id_job,Request $request,$id,$jobid,$detailid){
        // if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
        //     abort(404,"Page NotFound");
        // }
        $user = DB::select ("SELECT
        id
        FROM
        users
        where
        username = ? ",[$request->scanbarcode_pd]);

        $id_job_current_department = $id_job;
        if($user != null){
            job::Closejob($id_job_current_department,$jobid,$id,$detailid);
        }else{
            return redirect('/product'.'/'.$id_job.'/'.$jobid)/*->with('massage','ไม่มี User นี้ในระบบ')*/;
        }
        return redirect('/product'.'/'.$id_job.'/'.$jobid)/*->with('massage','การสแกนบาร์โค้ดส่งงานสำเร็จ')*/;

        // return $id;
    }

    public function qcchecklist($id_job,Request $request,$id,$jobid,$detailid)
    {

        // for($i = 1;$i<=219;$i++)
        // {
        //     if($i == $request->$i)
        //     {
        //         DB::insert("INSERT INTO Job_QC (Job_ID,Job_detail_ID,QC_ID,Type_QC,ID_screen,note)
        //         SELECT ?,job_detail.ID,?,'1',job_detail.ID_screen,? FROM job_detail
        //         WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.JobID = ? AND job_detail.status_job_detail = '2'", [$jobid,$request->$i,$id_job,$request->note,$id,$jobid]);

        //     }
        // }
        // $count_detail = DB::table('job_detail')->distinct('job_detail.ID_screen')->where('job_detail.JobID', $jobid)->where('job_detail.DepartmentID', $id_job)->count('job_detail.ID_screen');
        // $count_qc = DB::table('Job_QC')->distinct('Job_QC.ID_screen')->where('Job_QC.Job_ID', $jobid)->count('Job_QC.ID_screen');

        //update status
        // DB::update("INSERT INTO job_detail (EmployeeID,status_job_detail) VALUES (? ,'4')  WHERE JobID = ? AND productID = ? AND DepartmentID = ? AND status_job_detail = '2'",[$jobid,$id,$id_job_current_department]);
        // if($count_detail == $count_qc)
        // {
        //     DB::update("UPDATE job SET job.job_current_department = '999' WHERE job.ID = ?", [$jobid]);
        //     return redirect('/product'.'/'.$id_job);
        // }

        // if($count_detail != $count_qc)
        // {
        //     return redirect('/product'.'/'.$id_job.'/'.$jobid);
        // }
        DB::update("UPDATE job SET job.job_current_department = '999' WHERE job.ID = ?", [$jobid]);
        return redirect('/product'.'/'.$id_job);

        // return redirect('/product'.'/'.$id_job.'/'.$jobid);
        // return $count_qc;
    }

    public function qc_uncomplete($id_job,Request $request,$id,$jobid,$detailid)
    {
        $j = 0;
        for($i = 1;$i<=219;$i++)
        {
            if($i == $request->$i)
            {
                DB::insert("INSERT INTO Job_QC (Job_ID,Job_detail_ID,QC_ID,Type_QC,note)
                SELECT ?,job_detail.ID,?,'2',? FROM job_detail
                WHERE job_detail.DepartmentID =  ? AND job_detail.productID = ? AND job_detail.JobID = ? AND job_detail.status_job_detail = 2 ", [$jobid,$request->$i,$request->note[$j],$id_job,$id,$jobid,]);
                $j++;
            }
        }
            // DB::update("UPDATE job_detail SET job_detail.status_job_detail = '1' WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.ID = ?", [$id_job,$id,$detailid]);

            // DB::insert("INSERT INTO job_detail (JobID,ID_screen,productID,DepartmentID,status_job_detail,created_at)
            //     SELECT  job_detail.JobID,job_detail.ID_screen,job_detail.productID,job_detail.DepartmentID,'0',now() FROM job_detail
            //     WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.ID = ?", [$id_job,$id,$detailid]);

            DB::update("UPDATE job_detail SET job_detail.status_job_detail = '1' WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.status_job_detail != 2 ", [$id_job,$id]);

            DB::insert("INSERT INTO job_detail (JobID,ID_screen,productID,DepartmentID,step_job_department,status_job_detail)
            SELECT  job_detail.JobID,job_detail.ID_screen,job_detail.productID,job_detail.DepartmentID,job_detail.step_job_department,'0' FROM job_detail
            WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.status_job_detail = 2", [$id_job,$id]);


            DB::update("UPDATE job_detail SET job_detail.status_job_detail = '1' WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.status_job_detail = 2 ", [$id_job,$id]);

        return redirect('/product'.'/'.$id_job);
    }

    public function fqcchecklist($id_job,Request $request,$id,$jobid,$detailid)
    {
        for($i = 1;$i<=219;$i++)
        {
            if($i == $request->$i)
            {
                DB::insert("INSERT INTO Job_QC (Job_ID,Job_detail_ID,QC_ID,Type_QC)
                SELECT ?,job_detail.ID,?,'2' FROM job_detail
                WHERE job_detail.DepartmentID =  ? AND job_detail.productID = ? AND job_detail.JobID = ?", [$jobid,$request->$i,$id_job,$id,$jobid]);

            }
        }
            DB::update("UPDATE job SET job.job_current_department = '999' WHERE job.ID = ?", [$jobid]);
            return redirect('/product'.'/'.$id_job);

        return redirect('/product'.'/'.$id_job.'/'.$jobid);
    }

    public function fqc_uncomplete($id_job,Request $request,$id,$jobid,$detailid)
    {
        for($i = 1;$i<=219;$i++)
        {
            if($i == $request->$i)
            {
                DB::insert("INSERT INTO Job_QC (Job_ID,Job_detail_ID,QC_ID,Type_QC)
                SELECT ?,job_detail.ID,?,'2' FROM job_detail
                WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.status_job_detail = '0'", [$jobid,$request->$i,$id_job,$id]);
            }
        }
            // DB::insert("INSERT INTO job_detail (Job_ID,ID_screen,productID,DepartmentID,status_job_detail,created_at)
            //     SELECT  job_detail.Job_ID,job_detail.ID_screen,job_detail.productID,job_detail.DepartmentID,job_detail.status_job_detail,now() FROM job_detail
            //     WHERE job_detail.DepartmentID = ? AND job_detail.productID = ?", [$id_job,$id]);

                DB::update("UPDATE job SET job.job_current_department =
                    (SELECT qcchecklist.departmentID FROM Job_QC INNER JOIN qcchecklist ON Job_QC.QC_ID = qcchecklist.ID
                    WHERE Job_QC.Job_ID = 83 AND Job_QC.QC_ID =  (SELECT Min(Job_QC.QC_ID) FROM Job_QC INNER JOIN job_detail
                    ON Job_QC.Job_detail_ID = job_detail.ID WHERE Job_QC.Job_ID = 83 AND job_detail.status_job_detail = 0)
                    LIMIT 1)
                    WHERE job.ID = ?", [$jobid,$jobid]);



                $id_department = DB::select("SELECT Job_QC.Job_detail_ID FROM Job_QC WHERE Job_QC.Job_ID= ?",[$jobid]);

                DB::update("UPDATE job_detail SET job_detail.status_job_detail = 1
                WHERE JobID = ? AND step_job_department = 6 AND status_job_detail != 0 ", [$jobid]);

                DB::insert("INSERT INTO job_detail (
                    job_detail.JobID,
                    job_detail.ID_screen,
                    job_detail.productID,
                    job_detail.DepartmentID,
                    job_detail.step_job_department,
                    job_detail.status_job_detail)
                    SELECT
                    job_detail.JobID,
                    job_detail.ID_screen,
                    job_detail.productID,
                    (SELECT qcchecklist.departmentID FROM Job_QC INNER JOIN qcchecklist ON Job_QC.QC_ID = qcchecklist.ID
                    WHERE Job_QC.Job_ID = 83 AND Job_QC.QC_ID =  (SELECT Min(Job_QC.QC_ID) FROM Job_QC INNER JOIN job_detail
                    ON Job_QC.Job_detail_ID = job_detail.ID WHERE Job_QC.Job_ID = 83 AND job_detail.status_job_detail = 0)
                    LIMIT 1) AS DepartmentID,
                    (SELECT qcchecklist.departmentID FROM Job_QC INNER JOIN qcchecklist ON Job_QC.QC_ID = qcchecklist.ID
                    WHERE Job_QC.Job_ID = 83 AND Job_QC.QC_ID =  (SELECT Min(Job_QC.QC_ID) FROM Job_QC INNER JOIN job_detail
                    ON Job_QC.Job_detail_ID = job_detail.ID WHERE Job_QC.Job_ID = 83 AND job_detail.status_job_detail = 0)
                    LIMIT 1) AS step_job_department,
                    9
                    FROM
                    job_detail
                    where
                    JobID = ? AND status_job_detail = 0 AND step_job_department = 6
                    ",[$jobid,$jobid,$jobid]);

                    DB::update("UPDATE job_detail SET job_detail.status_job_detail = 1
                    WHERE JobID = ? AND step_job_department = 6 AND status_job_detail = 0 ", [$jobid]);

                    DB::update("UPDATE job_detail SET job_detail.status_job_detail = 0
                    WHERE JobID = ? AND step_job_department = 6 AND status_job_detail = 9 ", [$jobid]);

            // DB::update("UPDATE job SET job.job_current_department = '7' WHERE job_detail.DepartmentID = ? AND job_detail.productID = ?", [$id_job,$id]);
        return redirect('/product'.'/'.$id_job);
    }
    public function send_to_doctor(Request $request,$id_job,$id,$jobid,$detailid){


        DB::insert("INSERT INTO job_detail (JobID,ID_screen,productID,DepartmentID,step_job_department,status_job_detail)
        SELECT  job_detail.JobID,job_detail.ID_screen,job_detail.productID,996,996,'0' FROM job_detail
        WHERE job_detail.DepartmentID = ? AND job_detail.productID = ? AND job_detail.status_job_detail = 2", [$id_job,$id]);

        DB::update("UPDATE job SET job.job_current_department = '996' WHERE job.ID = ?", [$jobid]);
        return redirect('/product'.'/'.$id_job);
    }

}
