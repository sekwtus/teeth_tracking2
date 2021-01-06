<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class menu extends Model
{
    protected $table = 'menu';

    public static function select()
    {
        return DB::select("SELECT
        menu.menu_id,
        menu.menu_parent,
        menu.menu_code,
        menu.menu_name,
        menu.menu_datapath,
        menu.menu_icon,
        menu.menu_status,
        menu.created_by,
        menu.modified_by
        FROM
        menu
        ORDER BY
        menu.menu_code ASC", []);
    }

    public static function select_name()
    {
        return DB::select("SELECT
                            menu_name
                            FROM
                            menu
                            WHERE
                            ( menu.menu_code % 100 ) = 0
                            ORDER BY
                            menu.menu_code ASC", []);
    }
    // public static function insert($Name,$CustomerTypeID,$AreaID)
    // {
    //     DB::insert("INSERT INTO customer (Name,CustomerTypeID,AreaID) VALUES ('$Name','$CustomerTypeID','$AreaID')" ,[]);
    // }

    // public static function update_by_id($id,$Name,$CustomerTypeID,$AreaID)
    // {
    //     DB::update("UPDATE customer SET Name = '$Name',CustomerTypeID = '$CustomerTypeID',AreaID = '$AreaID' WHERE id = '$id'", []);
    // }

    // public static function delete_by_id($id)
    // {
    //     DB::delete("DELETE FROM customer WHERE id = '$id'", []);
    // }
}
