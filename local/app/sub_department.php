<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;

class sub_department extends Model
{
    protected $table = 'sub_department';

    public static function withoutSale(){
        return DB::select("SELECT
                sub_department.ID,
                sub_department.DepartmentID,
                sub_department.`Name`,
                department.`Name` AS dep_name
                FROM
                sub_department
                LEFT JOIN department ON department.ID = sub_department.DepartmentID
                WHERE
                sub_department.ID NOT IN (2,3,4,5)
                ORDER BY
                sub_department.DepartmentID ASC
                            ", []);
    }
}
