<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class user_group_permission extends Model
{
    protected $table = 'user_group_permission';

    public static function select_all()
    {
        return DB::select("SELECT * FROM user_group_permission", []);
    }

    public static function select_by_id($id)
    {

    }

    public static function insert($manu_name,$id_type,$noneActive)
    {
        $user_group_permission = new user_group_permission();

        // $user_group_permission->Name = $Name;
        // $user_group_permission->save();

        DB::insert("INSERT INTO user_group_permission (Name,group_id,permission) values ('$manu_name','$id_type','$noneActive')", []);

        // DB::update("UPDATE user_group_permission SET permission = '0' where group_id = '$id_type_name' ", []);

        // $date = today()->addMonth();
        // DB::insert("INSERT INTO type_users (Name,create_at) VALUES ('$Name','$date')" ,[]);
    }

    public static function update0($id_type_name,$isActive)
    {
        $user_group_permission = new user_group_permission();

        DB::update("UPDATE user_group_permission SET permission = '$isActive' where group_id = '$id_type_name' ", []);
    }

    public static function update1($Name,$id_type_name,$isActive)
    {
        $user_group_permission = new user_group_permission();

        DB::update("UPDATE user_group_permission SET permission = '$isActive' where group_id = '$id_type_name' and Name = '$Name' ", []);
    }


    // public static function update_by_id($id,$Name)
    // {
    //     DB::update("UPDATE company SET Name = '$Name' WHERE id = '$id'", []);
    // }

    // public static function delete_by_id($id)
    // {
    //     DB::delete("DELETE FROM company WHERE id = '$id'", []);
    // }
}
