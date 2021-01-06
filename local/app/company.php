<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class company extends Model
{
    protected $table = 'company';

    public static function select_all()
    {
        return DB::select("SELECT company.ID,company.`Name`,company.fullname FROM company", []);
    }

    public static function select_by_id($id)
    {

    }

    public static function insert($Name)
    {
        DB::insert("INSERT INTO company (Name) VALUES ('$Name')" ,[]);
    }

    public static function update_by_id($id,$Name)
    {
        DB::update("UPDATE company SET Name = '$Name' WHERE id = '$id'", []);
    }

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM company WHERE id = '$id'", []);
    }
}
