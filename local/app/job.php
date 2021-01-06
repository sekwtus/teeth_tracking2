<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Gate;

class job extends Model
{
    protected $table = 'job';

    public static function select_job1($id_job)
    {
        return  DB::table('job')
                        ->select(
                            'job.ID',
                            'job.ID_order_screen',
                            'type_Branch.Name as BranchID',
                            'department.Name as job_current_department',
                            'job.date_time_start',
                            'job.date_time_finish',
                            'order_screen.Barcode',
                            'Employee.Name',
                            'Employee.Nick_name')
                        ->leftJoin('type_Branch','job.BranchID','=','type_Branch.ID')
                        ->leftJoin('department','job.job_current_department','=', 'department.ID')
                        ->leftJoin('order_screen','job.ID_order_screen','=', 'order_screen.ID')
                        ->leftJoin('Employee','order_screen.SaleID','=','Employee.ID')
                        ->leftJoin('job_detail','job_detail.JobID','=','job.ID')
                        ->where('job.job_current_department','=',$id_job)
                        ->where('job_detail.status_job_detail','1')
                        ->get();
    
    }

    public static function select_job($id_job,$Subdepartment_id)
    {
          if (Gate::allows('IsAdmin')) {
            return DB::table('job')
                          ->select(
                              'job.ID',
                              'job.ID_order_screen',
                              'job.Note_QC',
                              'job.Note_Service',
                              'type_Branch.Name as BranchID',
                              'department.Name as job_current_department',
                              'job.date_time_start',
                              'job.date_time_finish',
                              'order_screen.Barcode',
                              'Employee.Name',
                              'Employee.Nick_name')
                          ->leftJoin('type_Branch','job.BranchID','=','type_Branch.ID')
                          ->leftJoin('department','job.job_current_department','=', 'department.ID')
                          ->leftJoin('order_screen','job.ID_order_screen','=', 'order_screen.ID')
                          ->leftJoin('Employee','order_screen.SaleID','=','Employee.ID')
                          ->leftJoin('job_detail','job_detail.JobID','=','job.ID')
                          ->where('job.job_current_department','=',$id_job)
                          ->where('job_detail.Sub_DepartmentID','=',$Subdepartment_id)
                          ->where('job_detail.status_job_detail','1')
                          ->where('job.status','3')
                          ->groupBy('order_screen.Barcode')
                          ->get();
          } else {
            $user_id = Auth::user()->id;
            return DB::table('job')
                          ->select(
                              'job.ID',
                              'job.ID_order_screen',
                              'job.Note_QC',
                              'job.Note_Service',
                              'type_Branch.Name as BranchID',
                              'department.Name as job_current_department',
                              'job.date_time_start',
                              'job.date_time_finish',
                              'order_screen.Barcode',
                              'Employee.Name',
                              'Employee.Nick_name')
                          ->leftJoin('type_Branch','job.BranchID','=','type_Branch.ID')
                          ->leftJoin('department','job.job_current_department','=', 'department.ID')
                          ->leftJoin('order_screen','job.ID_order_screen','=', 'order_screen.ID')
                          ->leftJoin('Employee','order_screen.SaleID','=','Employee.ID')
                          ->leftJoin('job_detail','job_detail.JobID','=','job.ID')
                          ->where('job.job_current_department','=',$id_job)
                          ->where('job_detail.Sub_DepartmentID','=',$Subdepartment_id)
                          ->where('job_detail.status_job_detail','1')
                          ->where('job.status','3')
                          ->where('job_detail.EmployeeID','=',$user_id)
                          ->groupBy('order_screen.Barcode')
                          ->get();

            
          }
        }

    public static function select_job_qc($id_job,$Subdepartment_id, $job_detail_created_at)
    {
        // dd($id_job,$Subdepartment_id, $job_detail_created_at,Auth::user()->id);
          if (Gate::allows('IsAdmin')) {
            return DB::table('job')
                          ->select(
                              'job.ID',
                              'job.ID_order_screen',
                              'job.Note_QC',
                              'job.Note_Service',
                              'type_Branch.Name as BranchID',
                              'department.Name as job_current_department',
                              'job.date_time_start',
                              'job.date_time_finish',
                              'order_screen.Barcode',
                              'Employee.Name',
                              'Employee.Nick_name')
                          ->leftJoin('type_Branch','job.BranchID','=','type_Branch.ID')
                          ->leftJoin('department','job.job_current_department','=', 'department.ID')
                          ->leftJoin('order_screen','job.ID_order_screen','=', 'order_screen.ID')
                          ->leftJoin('Employee','order_screen.SaleID','=','Employee.ID')
                          ->leftJoin('job_detail','job_detail.JobID','=','job.ID')
                          ->where('job.job_current_department','=',$id_job)
                          ->where('job_detail.Sub_DepartmentID','=',$Subdepartment_id)
                          ->where('job_detail.status_job_detail','1')
                          ->where('job.status','3')
                          ->groupBy('order_screen.Barcode')
                          ->get();
          } else {
            $user_id = Auth::user()->id;
            // return DB::table('job')
            //               ->select(
            //                   'job.ID',
            //                   'job.ID_order_screen',
            //                   'job.Note_QC',
            //                   'job.Note_Service',
            //                   'type_Branch.Name as BranchID',
            //                   'department.Name as job_current_department',
            //                   'job.date_time_start',
            //                   'job.date_time_finish',
            //                   'order_screen.Barcode',
            //                   'Employee.Name',
            //                   'Employee.Nick_name')
            //               ->leftJoin('type_Branch','job.BranchID','=','type_Branch.ID')
            //               ->leftJoin('department','job.job_current_department','=', 'department.ID')
            //               ->leftJoin('order_screen','job.ID_order_screen','=', 'order_screen.ID')
            //               ->leftJoin('Employee','order_screen.SaleID','=','Employee.ID')
            //               ->leftJoin('job_detail','job_detail.JobID','=','job.ID')
            //               ->where('job.job_current_department','=',$id_job)
            //               ->where('job_detail.Sub_DepartmentID','=',$Subdepartment_id)
            //               ->where('job_detail.status_job_detail','1')
            //               ->where('job.status','3')
            //               ->where('job_detail.EmployeeID','=',$user_id)
            //               ->groupBy('order_screen.Barcode')
            //               ->get();

            
            return DB::SELECT("SELECT
                            
                            job.ID ,
                            job.ID_order_screen,
                            job.Note_QC,
                            job.Note_Service,
                            type_Branch.`Name` AS BranchID,
                            department.`Name` AS job_current_department,
                            job.date_time_start,
                            job.date_time_finish,
                            order_screen.Barcode,
                            Employee.`Name`,
                            Employee.Nick_name
                            FROM
                            job
                            LEFT JOIN type_Branch ON job.BranchID = type_Branch.ID
                            LEFT JOIN department ON job.job_current_department = department.ID
                            LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                            LEFT JOIN Employee ON order_screen.SaleID = Employee.ID
                            LEFT JOIN job_detail ON job_detail.JobID = job.ID
                            WHERE
                            job.job_current_department = '$id_job' AND
                            job_detail.Sub_DepartmentID = '$Subdepartment_id' AND
                            job_detail.status_job_detail = 1 AND
                            job_detail.job_status = 3 AND		
                            job.`status` = 3 AND
                            job_detail.EmployeeID = '$user_id' 
                            --  AND
                            --   job_detail.created_at LIKE '$job_detail_created_at%'
                            GROUP BY
                            order_screen.Barcode
            ");
            
          }
          
          
         

            // return DB::select("SELECT
            //             job.ID,
            //             job.ID_order_screen,
            //             job.Note_QC,
            //             job.Note_Service,
            //             type_Branch.`Name` AS BranchID,
            //             department.`Name` AS job_current_department,
            //             order_screen.Barcode,
            //             job.date_time_start,
            //             job.date_time_finish,
            //             Employee.`Name`,
            //             Employee.Nick_name,
            //             job_detail.EmployeeID
            //             FROM
            //             job
            //             LEFT JOIN type_Branch ON job.BranchID = type_Branch.ID
            //             LEFT JOIN department ON job.job_current_department = department.ID
            //             LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
            //             LEFT JOIN Employee ON order_screen.SaleID = Employee.ID
            //             LEFT JOIN job_detail ON job_detail.JobID = job.ID
            //             WHERE
            //             job.job_current_department = '$id_job' AND
            //             job_detail.Sub_DepartmentID = '$Subdepartment_id' AND
            //             job_detail.status_job_detail = 1 AND
            //             job.`status` = 3 AND
            //             job_detail.EmployeeID = '?'
            //             GROUP BY
            //             order_screen.Barcode",[$user_id]);
    }

    public static function select_job_current_2($id_job)
    {
        return  DB::select ("SELECT
                            job.ID,
                            job.ID_order_screen,
                            order_screen.Barcode,
                            job.job_current_department,
                            department.`Name` AS name_Department,
                            Employee1.Nick_name AS name_sale,
                            Employee2.Nick_name AS name_tec,
                            job.date_time_start,
                            job.date_time_finish,
                            job.created_at,
                            job.updated_at,
                            sub_department.Name AS Name_sub_department
                            FROM
                            job
                            LEFT JOIN department ON job.job_current_department = department.ID
                            LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                            LEFT JOIN Employee AS Employee1 ON Employee1.ID = order_screen.SaleID
                            LEFT JOIN job_detail ON job.ID = job_detail.JobID
                            LEFT JOIN sub_department ON job_detail.Sub_DepartmentID = sub_department.ID
                            LEFT JOIN Employee AS Employee2 ON Employee2.ID = job_detail.EmployeeID
                            WHERE job.job_current_department = '$id_job' AND job_detail.ID IN (SELECT MAX(id) FROM job_detail GROUP BY job_detail.JobID)
                    ");

    }

    public static function select_job_current($id_job)
    {
        // return  DB::select ("SELECT
        //                     order_screen.ID,
        //                     order_screen.Barcode,
		// 					job_detail.Sub_DepartmentID,
        //                     -- users.ID_area AS ID_area,
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
        //                     area.`Name` AS ID_area,
        //                     GROUP_CONCAT( DISTINCT teeth.Name) AS Teeth_ID,
        //                     GROUP_CONCAT( DISTINCT type_of_product.Name separator ' / ') AS type_of_product,
        //                     order_screen.Datefinal,
        //                     processround.production_cycle,
        //                     job.ID AS ID_job,
        //                     zone.Name AS Zonename,
        //                     company.Name AS company_name
        //                 FROM
        //                     order_screen
        //                     LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
        //                     LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
        //                     LEFT JOIN customer ON customer.ID = order_screen.CustomerID
        //                     LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
        //                     LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
        //                     LEFT JOIN job ON job.ID_order_screen = order_screen.ID
		// 					LEFT JOIN job_detail ON job_detail.JobID = job.ID
        //                     LEFT JOIN department ON job.job_current_department = department.ID
        //                     LEFT JOIN users ON users.id = order_screen.SaleID
        //                     LEFT JOIN area ON area.ID = customer.AreaID
        //                     LEFT JOIN zone ON zone.ID = area.ZoneID
        //                     LEFT JOIN screen ON order_screen.ID = screen.ID_order_screen
        //                     LEFT JOIN processround ON processround.ID = order_screen.processroundID
        //                     LEFT JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID
        //                     LEFT JOIN teeth ON teeth.ID = order_teeth_screen.TeethID
        //                     LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
        //                     LEFT JOIN company ON company.ID = order_screen.FactoryID
        //                 WHERE
        //                     job.job_current_department = '$id_job'
        //                     -- AND job.ID NOT IN (SELECT job_detail.JobID FROM job_detail WHERE job_detail.DepartmentID = '$id_job')
        //                     AND (job.status is NULL)
        //                 GROUP BY
        //                     order_screen.Barcode
        //                 ORDER BY
        //                     order_screen.ID DESC
        //             ");

        return DB::select("SELECT
        order_screen.ID AS ID,
        order_screen.Barcode AS Barcode,
        order_screen.RefBarcode AS RefBarcode,
        order_screen.ContiBarcode AS ContiBarcode,
        order_screen.StartDate AS StartDate,
        order_screen.DeliverDate AS DeliverDate,
        order_screen.PatientName AS PatientName,
        type_Deliver.`Name` AS DeliverType,
        customer.AreaID AS ID_area,
        customer.`Name` AS customer,
        doctor.`Name` AS doctor,
        processround.production_cycle AS production_cycle,
        area.`Name` AS name_area,
        group_concat( DISTINCT `type_of_product`.`Name` SEPARATOR ' /	' ) AS type_of_product,
        zone.`Name` AS Zonename,
        company.`Name` AS company_name,
        work_defect.detail_type AS work_edit,
        b.detail_type AS work_late,
        order_screen.job_current_department AS current_department,
        order_screen.job_current_sub_department AS current_sub_department
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
        LEFT JOIN work_defect AS b ON ((order_screen.ddlWorkLate = b.id)))))
        RIGHT JOIN ( SELECT job.ID_order_screen FROM job WHERE job.job_current_department = '$id_job' AND job.`status` IS NULL )
        AS job ON job.ID_order_screen= order_screen.ID
        GROUP BY
        order_screen.Barcode
        ORDER BY
        ID DESC
        ");

    }


    public static function select_job_detail_current($id_job)
    {
        return  DB::select ("SELECT
                            job_detail.ID,
                            job_detail.JobID,
                            job_detail.status_job_detail,
                            job_detail.DepartmentID,
                            department.Name AS name_Department,
                            job_detail.EmployeeID,
                            Employee.Nick_name AS name_Employee,
                            job_detail.created_at,
                            job_detail.updated_at
                            FROM
                            job_detail
                            Left JOIN department ON job_detail.DepartmentID = department.ID
                            Left JOIN Employee ON job_detail.EmployeeID = Employee.ID
                            Left JOIN job ON job_detail.JobID = job.ID
                            -- Left JOIN screen ON job.ID_order_screen = screen.ID_order_screen
                            WHERE job_detail.DepartmentID = '$id_job'
                            -- AND job_detail.status_job_detail != '1'
                            -- AND job_detail.status_job_detail != '4'
                            AND job_detail.status_job_detail = '1'
                            AND job_detail.ID IN (SELECT MAX(job_detail.id) FROM job_detail GROUP BY job_detail.JobID,Sub_DepartmentID)
                            ORDER BY job_detail.JobID
                    ");

    }

    public static function select_detail_job()
    {
        return DB::select ("SELECT
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
                        job_detail.created_at,
                        job_detail.updated_at
                        FROM
                        job_detail
                        INNER JOIN department ON job_detail.DepartmentID = department.ID
                        Left JOIN Employee ON job_detail.EmployeeID = Employee.ID
                        INNER JOIN screen ON job_detail.ID_screen = screen.ID
                        WHERE job_detail.JobID = null AND job_detail.status_job_detail ='2'
                        GROUP BY productID
                    ");

    }

    public static function select_detail_job_id($id,$id_job)
    {
        $sql = "SELECT
                Max(job_detail.ID),
                job_detail.ID,
                job_detail.JobID,
                type_of_product.`Name` AS productName,
                job_detail.productID,
                GROUP_CONCAT( DISTINCT teeth.`Name` ) AS Teeth_ID,
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
                job_detail.created_at,
                job_detail.updated_at,
                Employee.`Name`,
                job.ID_order_screen,
                order_screen.Barcode
                FROM
                job_detail
                INNER JOIN department ON job_detail.DepartmentID = department.ID
                LEFT JOIN Employee ON job_detail.EmployeeID = Employee.ID
                INNER JOIN screen ON job_detail.ID_screen = screen.ID
                INNER JOIN type_of_product ON job_detail.productID = type_of_product.ID
                INNER JOIN teeth ON screen.TeethID = teeth.ID
                INNER JOIN job ON job_detail.JobID = job.ID
                INNER JOIN order_screen ON job.ID_order_screen = order_screen.ID
                WHERE
                job_detail.JobID = ? AND
                job_detail.DepartmentID = ? AND
                job_detail.status_job_detail != '1' AND
                job_detail.status_job_detail != '4'
                GROUP BY
                job_detail.status_job_detail
                ORDER BY
                job_detail.ID DESC
                    LIMIT 1
                    ";
                    //  Max(job_detail.ID),
                    //  job_detail.ID,
                    //  job_detail.JobID,
                    //  type_of_product.Name as productName,
                    //  job_detail.productID,
                    //  GROUP_CONCAT( DISTINCT teeth.`Name`) AS Teeth_ID,
                    //  department.`Name` AS DepartmentID,
                    //  job_detail.step_job_department,
                    //  job_detail.Name_person,
                    //  job_detail.time_process,
                    //  job_detail.time_waiting,
                    //  Employee.Nick_name AS EmployeeID,
                    //  job_detail.action_detail,
                    //  job_detail.Name_person,
                    //  job_detail.detail_job,
                    //  job_detail.picture_job,
                    //  job_detail.status_job_detail,
                    //  job_detail.created_at,
                    //  job_detail.updated_at
                    //  FROM
                    //  job_detail
                    //  INNER JOIN department ON job_detail.DepartmentID = department.ID
                    //  LEFT JOIN Employee ON job_detail.EmployeeID = Employee.ID
                    //  INNER JOIN screen ON job_detail.ID_screen = screen.ID
                    //  INNER JOIN type_of_product ON job_detail.productID = type_of_product.ID
                    //  INNER JOIN teeth ON screen.TeethID = teeth.ID
                    //  WHERE
                    //  job_detail.JobID = ? AND job_detail.DepartmentID = ?
                    //  AND job_detail.status_job_detail !='1'
                    //  AND job_detail.status_job_detail !='4'
                    //  AND job_detail.status_job_detail ='2'
                    //  GROUP BY
                    //  job_detail.productID
        return DB::select($sql , [$id,$id_job]);
    }

    public static function select_sale_job_id($id)
    {
        $sql = ("SELECT
        job.ID,
        job.ID_order_screen,
        job.count,
        Employee.`Name` AS NameSale,
        Employee.Nick_name AS NickNameSale,
        job.created_at,
        job.updated_at
        FROM
        job
        LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
        LEFT JOIN Employee ON order_screen.SaleID = Employee.ID
        WHERE
        job.ID = ?");

        return DB::select($sql , [$id]);
    }

    public static function select_fqc_checklist($id_job)
    {
        $sql = ("SELECT
        qcchecklist.ID,
        qcchecklist.departmentID,
        qcchecklist.ccp,
        qcchecklist.sub_department,
        sub_department.`Name`
        FROM
        qcchecklist
        INNER JOIN sub_department ON qcchecklist.sub_department = sub_department.ID
        ");

        return DB::select($sql , [$id_job]);
    }

    public static function select_qc_checklist($id_job)
    {
        $sql = "SELECT
        qcchecklist.ID,
        qcchecklist.departmentID,
        qcchecklist.ccp,
        qcchecklist.sub_department,
        sub_department.`Name`
        FROM
        qcchecklist
        INNER JOIN sub_department ON qcchecklist.sub_department = sub_department.ID
        WHERE
        qcchecklist.departmentID = '$id_job'";

        return DB::select($sql , [$id_job]);
    }

    public static function select_employee_job()
    {
        return DB::table('job_employee')
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
    }

    public static function insert_job_detail($id_job_current_department,$scanbarcode_pd)
    {
        DB::insert("INSERT INTO job_detail (JobID,productID,ID_screen,DepartmentID,step_job_department,status_job_detail,created_at)
        SELECT job.ID,'1',screen.ID,?,?,'0',now() FROM screen,job
        WHERE screen.ID_order_screen = ? AND job.ID_order_screen = ?", [$id_job_current_department,$id_job_current_department,$scanbarcode_pd,$scanbarcode_pd]);
    }

    public static function insert_job($JobID,$order_screen_ID,$EmployeeID,$id_job,$sub_depart)
    {
        DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,EmployeeID,status_job_detail,created_at,DepartmentID,Sub_DepartmentID,job_status)
         VALUES (?,?,?,'1',now(),?,?,'1')", [$JobID,$order_screen_ID,$EmployeeID,$id_job,$sub_depart]);
    }

    public static function update_job($JobID,$id_job,$sub_depart)
    {
        DB::update("UPDATE job_detail SET job_detail.status_job_detail = '2' WHERE job_detail.JobID = ? AND job_detail.DepartmentID = ? AND job_detail.Sub_DepartmentID = ? AND job_detail.status_job_detail != '4' AND job_detail.status_job_detail != '3'", [$JobID,$id_job,$sub_depart]);
    }


    public static function update_job_detail($id_job_current_department,$scanbarcode_pd)
    {
        $now = \Carbon\Carbon::now();
        DB::update("UPDATE job SET date_time_start = '$now', job.job_current_department = ? , job.status = NULL, job.updated_at = NOW() WHERE job.ID_order_screen = ?", [$id_job_current_department,$scanbarcode_pd]);
    }

    public static function update_job_detail_status($id_job)
    {
        DB::update("UPDATE job SET job.status = '1' WHERE job.ID = ?", [$id_job]);
    }

    public static function insert_Openjob($id_job_current_department,$scanbarcode_pd,$jobid,$id,$detailid)
    {
        // DB::update("UPDATE job_detail SET EmployeeID = ?,status_job_detail = '3'  WHERE JobID = ? AND productID = ? AND DepartmentID = ? AND ID = ?",[$scanbarcode_pd,$jobid,$id,$id_job_current_department,$detailid]);
        DB::insert("INSERT INTO job_detail (JobID,ID_screen,productID,DepartmentID,step_job_department,EmployeeID,status_job_detail,created_at) select JobID,ID_screen,1,DepartmentID,step_job_department,?,3,now() from job_detail where JobID = ? AND productID = ? AND DepartmentID = ? AND status_job_detail = 0",[$scanbarcode_pd,$jobid,$id,$id_job_current_department]);
    }

    public static function Closejob($id_job_current_department,$jobid,$id,$detailid)
    {
        // DB::update("UPDATE job_detail SET status_job_detail = '2' WHERE JobID = ? AND productID = ? AND DepartmentID = ? AND ID = ?", [$jobid,$id,$id_job_current_department,$detailid]);
        DB::insert("INSERT INTO job_detail (JobID,ID_screen,productID,DepartmentID,step_job_department,EmployeeID,status_job_detail,created_at,updated_at) select JobID,ID_screen,1,DepartmentID,step_job_department,EmployeeID,2,created_at,now() from job_detail where JobID = ? AND productID = ? AND DepartmentID = ? AND status_job_detail = 3",[$jobid,$id,$id_job_current_department]);
    }

    public static function select_for_dashboard_countAll()
    {
        $sql = "SELECT
                job.job_current_department,
                job.job_next_department,
                Count(job.job_current_department) as count
                FROM
                job
                WHERE
                job.job_current_department < 100
                GROUP BY
                job.job_next_department";

        return DB::select($sql , []);
    }

    public static function select_for_dashboard()
    {
        $sql = "SELECT
                job.job_current_department,
                job.job_next_department,
                Count(*) AS count
                FROM
                job
                WHERE
                job.job_current_department < 100
                GROUP BY
                job.job_current_department
                ";

        return DB::select($sql , []);
    }

    public static function select_data_finish_for_dashboard()
    {
        $sql = "SELECT
                job.job_current_department,
                job.job_next_department,
                Count(job.job_current_department) as count
                FROM
                job
                WHERE
                job.job_current_department = 998
                GROUP BY
                job.job_next_department";

        return DB::select($sql , []);
    }

    public static function select_job_continue()
    {
        $user_id = Auth::user()->id;
        $sql = "SELECT
                job.ID,
                job.ID_order_screen,
                job.job_current_department,
                order_screen.Barcode,
                order_screen.DoctorID,
                order_screen.SaleID,
                doctor.`Name`,
                department.`Name` AS current_status
                FROM
                job
                LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                LEFT JOIN department ON job.job_current_department = department.ID
                WHERE
                job.job_current_department = 996 AND
                order_screen.SaleID = '$user_id' ";


        return DB::select($sql , []);
    }

    public static function select_job_sendBack()
    {
        $user_id = Auth::user()->id;
        $sql = "SELECT
                job.ID,
                job.ID_order_screen,
                job.job_current_department,
                order_screen.Barcode,
                order_screen.DoctorID,
                order_screen.SaleID,
                doctor.`Name`,
                department.`Name` AS current_status
                FROM
                job
                LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                LEFT JOIN department ON job.job_current_department = department.ID
                WHERE
                job.job_current_department = 995 AND
                order_screen.SaleID = '$user_id' ";

        return DB::select($sql , []);
    }

    public static function select_job_detail_created_at($id_job, $Subdepartment, $JobID){
        $sql = "
                            SELECT
                            Max(job_detail.created_at) as created_at
                            FROM
                            job_detail
                            WHERE
                            job_detail.DepartmentID = '$id_job' AND
                            job_detail.status_job_detail = 1 AND
                            job_detail.job_status = 3 AND
                            job_detail.Sub_DepartmentID = '$Subdepartment' AND
                            job_detail.JobID = '$JobID'
             
        ";
        return DB::select($sql , []);
    }
    public static function select_job_detail($id_job, $Subdepartment_id){
        $user_id = Auth::user()->id;
        $sql ="
                            SELECT
                            job.ID
                            FROM
                            job
                            LEFT JOIN order_screen ON job.ID_order_screen = order_screen.ID
                            LEFT JOIN job_detail ON job_detail.JobID = job.ID
                            WHERE
                            job.job_current_department = '$id_job' AND
                            job_detail.Sub_DepartmentID = '$Subdepartment_id' AND
                            job_detail.status_job_detail = 1 AND
                            job.`status` = 3 AND
                            job_detail.EmployeeID = '$user_id'          
                            ";
        return DB::select($sql , []);
    }



}
