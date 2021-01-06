<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Step6MOdel extends Model
{
    protected $table = '่attachment';
    public static function select_all()
    {
        $sql = "SELECT * FROM attachment ";

        return DB::select($sql, []);
    }
    public static function select_by_id($id)
    {   
        $sql = "SELECT 
                    attachment.`Name`,
                    attachment.ID
                    FROM attachment 
                    WHERE attachment.AttachmentTypeID = {$id} ";
        return DB::select($sql, []);
    }
}
