<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class order_teeth extends Model
{
    protected $table = 'order_teeth';

    public static function select_product()
    {
        $sql = "SELECT
                    type_of_product.ID,
                    type_of_product.`Name`
                    FROM
                    type_of_product";

        return DB::select($sql , []);
    }

    public static function select_work()
    {
        $sql = "SELECT
                    type_of_work.ID,
                    type_of_work.`Name`
                    FROM
                    type_of_work";

        return DB::select($sql , []);
    }

    public static function select_teeth()
    {
        $sql = "SELECT
                    order_teeth.ID,
                    order_teeth.OrderID,
                    order_teeth.TeethID,
                    order_teeth.TypeOfWorkID,
                    order_teeth.TypeOfProductID,
                    type_of_work.`Name` AS NameWork,
                    type_of_product.`Name` AS NameProduct
                    FROM
                    order_teeth
                    INNER JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                    INNER JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                    WHERE
                    order_teeth.OrderID = ( SELECT order_sale.ID FROM order_sale WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1 )
                    AND order_teeth.ID IN ( ( SELECT MAX( order_teeth.ID ) FROM order_teeth GROUP BY order_teeth.TeethID ) )";

        return DB::select($sql , [Auth::user()->id]);
    }

    public static function screen_teeth($id)
    {
        $sql = "SELECT
        order_teeth.ID,
        order_teeth.ScreenID,
        order_teeth.TeethID,
        order_teeth.TypeOfWorkID,
        order_teeth.TypeOfProductID,
        type_of_work.`Name` AS NameWork,
        type_of_product.`Name` AS NameProduct
    FROM
        order_teeth
        LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
        LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
    WHERE
        order_teeth.ID IN ( ( SELECT MAX( order_teeth.ID ) FROM order_teeth WHERE OrderID = ? GROUP BY order_teeth.TeethID ORDER BY ScreenID DESC ) )";

        return DB::select($sql , [$id]);
    }

    public static function screen_teeth_group($id)
    {
        $sql = "SELECT
                    order_teeth.ID,
                    order_teeth.ScreenID,
                    order_teeth.TeethID,
                    order_teeth.TypeOfWorkID,
                    order_teeth.TypeOfProductID,
                    order_teeth.TypeOfGroupID,
                    order_teeth.GroupNo,
                    type_of_work.`Name` AS NameWork,
                    type_of_product.`Name` AS NameProduct,
                    type_of_group.`Name` AS NameGroup

                    FROM
                    order_teeth
                    LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                    LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                    LEFT JOIN type_of_group ON order_teeth.TypeOfGroupID = type_of_group.ID
                    WHERE
                    order_teeth.ID IN (( SELECT MAX( order_teeth.ID ) FROM order_teeth WHERE OrderID = '$id' GROUP BY order_teeth.TeethID ))";

        return DB::select($sql , [Auth::user()->id]);
    }

    public static function screen_teeth_group_order_screen($id)
    {
        $sql = "SELECT
                    order_teeth.ID,
                    order_teeth.ScreenID,
                    order_teeth.TeethID,
                    order_teeth.TypeOfWorkID,
                    order_teeth.TypeOfProductID,
                    order_teeth.TypeOfGroupID,
                    order_teeth.GroupNo,
                    type_of_work.`Name` AS NameWork,
                    type_of_product.`Name` AS NameProduct,
                    type_of_group.`Name` AS NameGroup

                    FROM
                    order_teeth
                    LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                    LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                    LEFT JOIN type_of_group ON order_teeth.TypeOfGroupID = type_of_group.ID
                    WHERE

                    order_teeth.ID IN (( SELECT MAX( order_teeth.ID ) FROM order_teeth Where order_teeth.ScreenID = '$id' GROUP BY order_teeth.TeethID ))";

        return DB::select($sql , []);
    }

    public static function select_teeth_group()
    {
        $sql = "SELECT
                    order_teeth.ID,
                    order_teeth.OrderID,
                    order_teeth.TeethID,
                    order_teeth.TypeOfWorkID,
                    order_teeth.TypeOfProductID,
                    order_teeth.TypeOfGroupID,
                    order_teeth.GroupNo,
                    type_of_work.`Name` AS NameWork,
                    type_of_product.`Name` AS NameProduct,
                    type_of_group.`Name` AS NameGroup

                    FROM
                    order_teeth
                    LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                    LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                    LEFT JOIN type_of_group ON order_teeth.TypeOfGroupID = type_of_group.ID
                    WHERE
                    order_teeth.OrderID = ( SELECT order_sale.ID FROM order_sale WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1 ) AND
                    order_teeth.ID IN (( SELECT MAX( order_teeth.ID ) FROM order_teeth GROUP BY order_teeth.TeethID ))";

        return DB::select($sql , [Auth::user()->id]);
    }

    public static function select_group()
    {
        $sql = "SELECT
                    MAX(order_teeth.GroupNo) as max_group
                    FROM
                    order_teeth
                    WHERE order_teeth.OrderID = (
                    SELECT order_sale.ID
                    FROM order_sale
                    WHERE order_sale.SaleID = ?
                    ORDER BY id DESC LIMIT 1)
                    AND order_teeth.ID IN (
                    SELECT MAX(order_teeth.ID)
                    FROM order_teeth
                    GROUP BY order_teeth.TeethID)";

        return DB::select($sql , [Auth::user()->id]);
    }

    public static function update_teeth_group($id)
    {
        DB::update("UPDATE order_teeth SET TypeOfGroupID = null, GroupNo = null where ID = '$id' ", []);
    }

    public static function delete_teeth($id,$id_screen,$TeethID)
    {
        DB::delete("DELETE FROM order_teeth WHERE ID = '$id'", []);
        DB::delete("DELETE FROM order_teeth_screen WHERE ScreenID = '$id_screen' and TeethID = '$TeethID' ", []);
        DB::delete("DELETE FROM screen WHERE ID_order_screen = '$id_screen' and TeethID = '$TeethID' ", []);
    }
}
