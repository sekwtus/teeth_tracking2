<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class factory extends Model
{
    protected $table = 'factory';

    public static function select_factory()
    {
        return DB::select("SELECT factory.`Name`,factory.ID FROM customer ,factory WHERE customer.AreaID = factory.ID GROUP BY factory.`Name`", []);
    }

    public static function select_by_id($id)
    {

    }

    public static function insert($Name,$CompanyID,$ZoneID)
    {
        DB::insert("INSERT INTO factory (Name,CompanyID,ZoneID) VALUES ('$Name','$CompanyID','$ZoneID')" ,[]);
    }

    public static function update_by_id($id,$Name,$CompanyID,$ZoneID)
    {
        DB::update("UPDATE factory SET Name = '$Name',CompanyID = '$CompanyID',ZoneID = '$ZoneID' WHERE id = '$id'", []);
    }

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM factory WHERE id = '$id'", []);
    }
}
