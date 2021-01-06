<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class type_of_group extends Model
{
    protected $table = 'type_of_group';

    public static function select_type_group()
    {
        $sql = "SELECT type_of_group.ID,type_of_group.`Name` FROM type_of_group";
        return DB::select($sql , []);
    }
}
