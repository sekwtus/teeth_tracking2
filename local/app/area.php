<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class area extends Model
{
    protected $table = 'area';

    public static function select_all()
    {
        return DB::select("SELECT area.ID,area.`Name` FROM area", []);
    }

    public static function select_by_id($id)
    {
        return DB::select("SELECT area.ID,area.`Name` FROM area WHERE area.BranchID = '$id'", []);
    }

    public static function insert($Name,$ZoneID)
    {
        DB::insert("INSERT INTO area (Name,ZoneID) VALUES ('$Name','$ZoneID')" ,[]);
    }

    public static function update_by_id($id,$Name,$ZoneID)
    {
        DB::update("UPDATE area SET Name = '$Name',ZoneID = '$ZoneID' WHERE id = '$id'", []);
    }

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM area WHERE id = '$id'", []);
    }
}
