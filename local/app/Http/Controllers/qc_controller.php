<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Gate;
use DB;
use App\order_sale;
use App\job;

class qc_controller extends Controller
{
    public function getIndex(Request $request){
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
            $data_job = DB::table('job')
                    ->select(
                        'job.ID',
                        'job.ID_order_screen',
                        'type_Branch.Name as BranchID',
                        'department.Name as job_current_department',
                        'job.date_time_start',
                        'job.date_time_finish')
                    ->join('type_Branch','job.BranchID','=','type_Branch.ID')
                    ->join('department','job.job_current_department','=', 'department.ID')
                    ->where('job.job_current_department','!=',0)
                    // ->orderBy('job.created_at')
                    // ->limit(1)
                    ->get();
            // $data_detailjob = DB::table('job_detail')
            //         ->select(
            //             'job_detail.ID',
            //             'job_detail.JobID',
            //             'job_detail.ID_screen',
            //             'job_detail.productID',
            //             'GROUP_CONCAT(DISTINCT screen.TeethID) AS Teeth_ID,',
            //             'department.Name as DepartmentID',
            //             'job_detail.step_job_department',
            //             'job_detail.Name_person',
            //             'job_detail.time_process',
            //             'job_detail.time_waiting',
            //             'Employee.Nick_name as EmployeeID',
            //             'job_detail.action_detail',
            //             'job_detail.Name_person',
            //             'job_detail.detail_job',
            //             'job_detail.picture_job',
            //             'job_detail.status_job_detail',
            //             'job_detail.created_at'
            //         )
            //         ->leftjoin('department','job_detail.DepartmentID','=','department.ID')
            //         ->leftjoin('Employee','job_detail.EmployeeID','=','Employee.ID')
            //         ->leftjoin('screen','job_detail.ID_screen','=','screen.ID')
            //         ->where('JobID','=',null)
            //         ->get();
            $data_detailjob = DB::select ("SELECT
                        job_detail.ID,
                        job_detail.JobID,
                        job_detail.productID,
                        GROUP_CONCAT(DISTINCT screen.TeethID) AS Teeth_ID,
                        department.Name AS DepartmentID ,
                        job_detail.step_job_department,
                        job_detail.Name_person,
                        job_detail.time_process,
                        job_detail.time_waiting,
                        Employee.Nick_name AS EmployeeID,
                        job_detail.action_detail,
                        job_detail.Name_person,
                        job_detail.detail_job,
                        job_detail.picture_job,
                        job_detail.status_job_detail,
                        job_detail.created_at
                        FROM
                        job_detail
                        INNER JOIN department ON job_detail.DepartmentID = department.ID
                        Left JOIN Employee ON job_detail.EmployeeID = Employee.ID
                        INNER JOIN screen ON job_detail.ID_screen = screen.ID
                        WHERE JobID = null
                        GROUP BY productID
                    ");
            $data_employee = DB::table('job_employee')
                    ->select(
                        'job_employee.ID',
                        'job_employee.EmployeeName',
                        'department.Name as department',
                        'job_employee.Job_target',
                        'job_employee.date_of_work',
                        'job_employee.start_time_of_work',
                        'job_employee.end_time_of_work',
                        'job_employee.status'
                    )
                    ->join('Employee' , 'job_employee.EmployeeID', '=' ,'Employee.ID')
                    ->join('department','job_employee.DepartmentID', '=', 'department.ID')
                    ->get();

        return view('Production.qc',compact('data_job','data_detailjob','data_employee'));
    }

    public function getselect($id){
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

            $data_job = DB::table('job')
                    ->select(
                        'job.ID',
                        'job.ID_order_screen',
                        'type_Branch.Name as BranchID',
                        'department.Name as job_current_department',
                        'job.date_time_start',
                        'job.date_time_finish')
                    ->join('type_Branch','job.BranchID','=','type_Branch.ID')
                    ->join('department','job.job_current_department','=', 'department.ID')
                    ->where('job.job_current_department','!=',0)
                    ->get();
            // $data_detailjob = DB::table('job_detail')
            //         ->select(
            //             'job_detail.ID',
            //             'job_detail.JobID',
            //             'job_detail.ID_screen',
            //             'job_detail.productID',
            //             'department.Name as DepartmentID',
            //             'job_detail.step_job_department',
            //             'job_detail.Name_person',
            //             'job_detail.time_process',
            //             'job_detail.time_waiting',
            //             'Employee.Nick_name as EmployeeID',
            //             'job_detail.action_detail',
            //             'job_detail.Name_person',
            //             'job_detail.detail_job',
            //             'job_detail.picture_job',
            //             'job_detail.status_job_detail',
            //             'job_detail.created_at'
            //         )
            //         ->leftjoin('department','job_detail.DepartmentID','=','department.ID')
            //         ->leftjoin('Employee','job_detail.EmployeeID','=','Employee.ID')
            //         ->where('JobID','=',$id)
            //         ->get();
            $data_detailjob = DB::select ("SELECT
                        Max(job_detail.ID),
                        job_detail.ID,
                        job_detail.JobID,
                        type_of_product.Name as productName,
                        job_detail.productID,
                        GROUP_CONCAT(DISTINCT screen.TeethID) AS Teeth_ID,
                        department.`Name` AS DepartmentID,
                        job_detail.step_job_department,
                        job_detail.Name_person,
                        job_detail.time_process,
                        job_detail.time_waiting,
                        Employee.Nick_name AS EmployeeID,
                        job_detail.action_detail,
                        job_detail.Name_person,
                        job_detail.detail_job,
                        job_detail.picture_job,
                        job_detail.status_job_detail,
                        job_detail.created_at
                        FROM
                        job_detail
                        INNER JOIN department ON job_detail.DepartmentID = department.ID
                        LEFT JOIN Employee ON job_detail.EmployeeID = Employee.ID
                        INNER JOIN screen ON job_detail.ID_screen = screen.ID
                        INNER JOIN type_of_product ON job_detail.productID = type_of_product.ID
                        WHERE
                        job_detail.JobID = ?
                        GROUP BY
                        job_detail.productID
                        ",[$id]);
            $data_employee = DB::table('job_employee')
                    ->select(
                        'job_employee.ID',
                        'job_employee.EmployeeName',
                        'department.Name as department',
                        'job_employee.Job_target',
                        'job_employee.date_of_work',
                        'job_employee.start_time_of_work',
                        'job_employee.end_time_of_work',
                        'job_employee.status'
                    )
                    ->join('Employee' , 'job_employee.EmployeeID', '=' ,'Employee.ID')
                    ->join('department','job_employee.DepartmentID', '=', 'department.ID')
                    ->get();

                    return view('Production.qc',compact('data_job','data_detailjob','data_employee'));
    }

    public function addJob(Request $request){
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        // $data_Job = new job();
        // $data_Job->ID_order_screen = $request->scanbarcode_pd;
        // $data_Job->BranchID = '1';
        // $data_Job->job_current_department ='1';
        // $data_Job->date_time_start = now();
        // $data_Job->save();
        DB::update("UPDATE job SET job.job_current_department = 1 WHERE job.ID_order_screen = ?", [$request->scanbarcode_pd]);
        // DB::insert("INSERT INTO job_detail (JobID,ID_screen) SELECT job.ID,screen.ID FROM screen,job WHERE screen.ID_order_screen = ? AND job.ID_order_screen = ?", [$request->scanbarcode_pd,$request->scanbarcode_pd]);
        // DB::insert("INSERT INTO job (ID_order_screen,BranchID,job_current_department,date_time_start,created_at,updated_at)
        // SELECT job.ID_order_screen,job.BranchID,'9',job.date_time_start,now(),now() FROM job
        // WHERE job.ID_order_screen = ? ORDER BY job.created_at DESC LIMIT 1", [$request->scanbarcode_pd]);

        DB::insert("INSERT INTO job_detail (JobID,ID_screen,DepartmentID,step_job_department)
        SELECT job.ID,screen.ID,'9','1' FROM screen,job
        WHERE screen.ID_order_screen = ? AND job.ID_order_screen = ?", [$request->scanbarcode_pd,$request->scanbarcode_pd]);

        return redirect('/qc');
    }

    public function Openjob(Request $request,$id,$jobid){
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        // DB::update("UPDATE job_detail SET EmployeeID = ? where ID = ? ", [$request->scanbarcode_pd,$id]);
        DB::update("UPDATE job_detail SET EmployeeID = ?  WHERE JobID = ? AND productID = ?",[$request->scanbarcode_pd,$jobid,$id]);

        // DB::insert("INSERT INTO job_detail ( JobID, ID_screen, productID, DepartmentID, step_job_department, EmployeeID, status_job_detail, created_at )
        //     SELECT
        //         job_detail.JobID,
        //         job_detail.ID_screen,
        //         job_detail.productID,
        //         job_detail.DepartmentID,
        //         job_detail.step_job_department,
        //         ?,
        //         job_detail.status_job_detail ,
        //         now()
        //     FROM
        //         job_detail
        //     WHERE
        //         job_detail.JobID = ?
        //         AND job_detail.productID = ?
        //     ORDER BY
        //         job_detail.ID ASC
        //         LIMIT 1", [$request->scanbarcode_pd,$jobid,$id]);

        return $id;
    }

    public function Closejob(Request $request,$id,$jobid)
    {
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        DB::update("UPDATE job_detail SET status_job_detail = '2' WHERE JobID = ? AND productID = ?", [$jobid,$id]);
        // DB::insert("INSERT INTO job_detail ( JobID, ID_screen, productID, DepartmentID, step_job_department, EmployeeID, status_job_detail, created_at )
        // SELECT
        //     job_detail.JobID,
        //     job_detail.ID_screen,
        //     job_detail.productID,
        //     job_detail.DepartmentID,
        //     '2',
        //     job_detail. EmployeeID,
        //     job_detail.status_job_detail ,
        //     now()
        // FROM
        //     job_detail
        // WHERE
        //     job_detail.JobID = ?
        //     AND job_detail.productID = ?
        // ORDER BY
        //     job_detail.ID ASC
        //     LIMIT 1", [$jobid,$id]);
        return redirect('/qc/'.$jobid);
    }
}
