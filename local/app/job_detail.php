<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class job_detail extends Model
{
    protected $table = 'job_detail';

    public static function select_data_for_packing_finished($id,$id_user){
        DB::insert("INSERT INTO job_detail ( 
            JobID, 
            productID, 
            ID_screen, 
            DepartmentID, 
            step_job_department, 
            status_job_detail,
            EmployeeID
            ) 
            SELECT
                job_detail.JobID,
                1 as productID,
                job_detail.ID_screen,
                7 as DepartmentID, 
                7 as step_job_department,
                2 as status_job_detail,
                ?
            FROM
                job_detail 
            WHERE
                job_detail.JobID = ?
            ", [$id_user,$id]);
    }

    public static function packing($id,$ID_user){
        DB::insert("INSERT INTO job_detail ( 
            JobID, 
            productID, 
            ID_screen, 
            DepartmentID, 
            step_job_department, 
            status_job_detail,
            EmployeeID
            ) 
            SELECT
                job_detail.JobID,
                1 as productID,
                job_detail.ID_screen,
                7 as DepartmentID, 
                7 as step_job_department,
                3 as status_job_detail,
                ?
            FROM
                job_detail 
            WHERE
                job_detail.JobID = ?
            ", [$ID_user,$id]);
    }
}
