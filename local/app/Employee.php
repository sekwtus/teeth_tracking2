<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    protected $table = 'Employee';

    public static function select_employee()
    {
        $sql = "SELECT
                users.id
                FROM
                Employee
                INNER JOIN users ON Employee.ID_user = users.id
                WHERE
                users.ID_type_users = 2";

        return DB::select($sql , [Auth::user()->id]);
    }

    public static function update_status($id)
    {
        DB::update("UPDATE Employee SET `status`=(`status` - 1)*(`status` - 1) WHERE id = ? ", [$id]);
    }

}
