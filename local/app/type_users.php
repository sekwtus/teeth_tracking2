<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class type_users extends Model
{
    protected $table = 'type_users';

    public static function select_all()
    {
        return DB::select("SELECT ID,Name FROM type_users", []);
    }

    public static function select_by_name($name)
    {
        return DB::select("SELECT ID,Name FROM type_users where Name = '$name' ", []);
    }

    public static function insert($Name)
    {
        $type_user = new type_users();

        $type_user->Name = $Name;
        $type_user->save();


        // $date = today()->addMonth();
        // DB::insert("INSERT INTO type_users (Name,create_at) VALUES ('$Name','$date')" ,[]);
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
