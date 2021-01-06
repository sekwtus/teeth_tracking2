<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class customer extends Model
{
    protected $table = 'customer';

    public static function select_by_user($id)
    {
        return DB::select("SELECT customer_type.id,customer_type.`name` FROM customer_type WHERE customer_type.id = '$id'", []);
    }

    public static function select_by_id($id)
    {
        // return DB::select("SELECT * from customer where CustomerTypeID = '$id' and AreaID = ?", [Auth::user()->ID_area]);
        return DB::select("SELECT * from customer where CustomerTypeID = '$id' and AreaID in (select area_id from user_area where user_id=?)", [Auth::user()->id]);
    }

    public static function select_by_Chiefsales($id)
    {
        return DB::select("SELECT customer_type.id,customer_type.`name` FROM customer_type WHERE customer_type.id = '$id'", []);
    }

    public static function select_by_id_Chiefsales($id,$id_area)
    {
        return DB::select("SELECT * from customer where CustomerTypeID = '$id' and AreaID = '$id_area'", []);
    }

    public static function insert($Name, $CustomerTypeID, $AreaID,$CustomerCode,$CustomerCode2,$short_Name,$send_object,$Tel,$send_bill,$TaxID)
    {
        DB::insert("INSERT INTO customer (Name,CustomerTypeID,AreaID,CustomerCode,CustomerCode2,short_Name,status,send_object,Tel,send_bill,TaxID) VALUES ('$Name','$CustomerTypeID','$AreaID','$CustomerCode','$CustomerCode2','$short_Name','1','$send_object','$Tel','$send_bill','$TaxID')", []);
    }

    public static function update_by_id($id, $Name, $CustomerTypeID, $AreaID, $short_Name, $CustomerCode, $CustomerCode2, $send_object, $send_bill, $Tel, $TaxID)
    {
        DB::update("UPDATE customer SET Name = '$Name',CustomerTypeID = '$CustomerTypeID',AreaID = '$AreaID', short_Name = '$short_Name', CustomerCode = '$CustomerCode', CustomerCode2 = '$CustomerCode2', send_object = '$send_object', send_bill = '$send_bill', Tel = '$Tel', TaxID = '$TaxID' WHERE id = '$id'", []);
    }

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM customer WHERE id = '$id'", []);
    }

    public static function update_status($id)
    {
        DB::update("UPDATE customer SET `status`=(`status` - 1)*(`status` - 1) WHERE id = ? ", [$id]);
    }
}
