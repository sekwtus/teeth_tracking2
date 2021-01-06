<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class doctor extends Model
{
    protected $table = 'doctor';

    public static function select_all()
    {

    }

    public static function select_by_id($id)
    {

    }

    public static function insert($Name,$Phone,$email)
    {
        DB::insert("INSERT INTO doctor (Name,Phone,email) VALUES ('$Name','$Phone','$email')" ,[]);
    }

    public static function update_by_id($id,$Name,$Phone,$email,$Line)
    {
        DB::update("UPDATE doctor SET Name = '$Name',Phone = '$Phone',email = '$email' , Line_doctor = '$Line' WHERE id = '$id'", []);
    }

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM doctor WHERE id = '$id'", []);
    }


    public static function update_status($id)
    {
        DB::update("UPDATE doctor SET `status`=(`status` - 1)*(`status` - 1) WHERE id = ? ", [$id]);
    }

}
