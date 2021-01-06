<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class department extends Model
{
    protected $table = 'department';

    public static function select_all()
    {
        return DB::select("SELECT * FROM
                            department
                            WHERE
                            department.ID < ?
                            ", [100]);
    }
}
