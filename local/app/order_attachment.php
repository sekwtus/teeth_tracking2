<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class order_attachment extends Model
{
    protected $table = 'order_attachment';

    public static function select_order_attachment()
    {
        $sql = "SELECT
                    order_attachment.AttachmentID,attachment.Name
                    FROM
                    order_attachment
                    INNER JOIN attachment
                    ON order_attachment.AttachmentID=attachment.ID
                    WHERE order_attachment.OrderID = (SELECT order_sale.ID
                    FROM order_sale
                    WHERE order_sale.SaleID = ?
                    ORDER BY id DESC LIMIT 1)";
        return DB::select($sql , [Auth::user()->id]);
    }

    public static function delete_attachment($id_order)
    {
        DB::delete("DELETE FROM order_attachment WHERE OrderID = '$id_order' AND AttachmentID = '0'", []);
    }
}
