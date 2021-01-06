<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class type_Branch extends Model
{
    protected $table = 'type_Branch';

    public static function select_by_id($radio)
    {
        return DB::select("SELECT type_Branch.ID,type_Branch.`Name` FROM type_Branch WHERE type_Branch.companyID = '$radio'", []);
    }
}
