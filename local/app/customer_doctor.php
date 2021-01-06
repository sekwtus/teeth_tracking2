<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class customer_doctor extends Model
{
    protected $table = 'customer_doctor';

    public static function select_doctor()
    {
        $sql = "SELECT
                    customer_doctor.Name_doctor AS 'ID',
                    doctor.Name AS 'Name'
                    FROM
                    customer_doctor
                    INNER JOIN doctor
                    ON doctor.ID=customer_doctor.Name_doctor
                    WHERE customer_doctor.Name_customer
                    IN (SELECT order_sale.CustomerID
                    from (select * from order_sale WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1)
                    as order_sale)";

        return DB::select($sql , [Auth::user()->id]);
    }
}
